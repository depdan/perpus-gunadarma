<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    public function borrow(Request $request, Book $book): RedirectResponse
    {
        $user = Auth::user();

        $activeLoan = Borrowing::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->where('status', 'dipinjam')
            ->first();

        if ($activeLoan) {
            return redirect()->back()->with('error', 'Anda sedang meminjam buku ini. Harap kembalikan terlebih dahulu sebelum meminjam kembali.');
        }

        try {
            DB::transaction(function () use ($book, $user) {
                $lockedBook = Book::where('id', $book->id)->lockForUpdate()->first();

                if (!$lockedBook || $lockedBook->stock <= 0) {
                    throw new \Exception('Stok buku tidak mencukupi untuk dipinjam.');
                }

                $lockedBook->decrement('stock');

                Borrowing::create([
                    'user_id' => $user->id,
                    'book_id' => $lockedBook->id,
                    'borrow_date' => now()->toDateString(),
                    'due_date' => now()->addDays(7)->toDateString(),
                    'status' => 'dipinjam',
                    'notes' => 'Peminjaman mandiri oleh anggota',
                ]);
            });

            return redirect()->route('peminjam.borrowings.history')
                ->with('success', "Buku '{$book->title}' berhasil dipinjam! Batas waktu pengembalian 7 hari.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage() ?: 'Gagal melakukan peminjaman buku.');
        }
    }

    public function returnBook(Request $request, Borrowing $borrowing): RedirectResponse
    {
        if ($borrowing->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengembalikan transaksi peminjaman ini.');
        }

        if ($borrowing->status === 'dikembalikan') {
            return redirect()->back()->with('info', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        try {
            DB::transaction(function () use ($borrowing) {
                $borrowing->update([
                    'status' => 'dikembalikan',
                    'return_date' => now()->toDateString(),
                ]);

                $lockedBook = Book::where('id', $borrowing->book_id)->lockForUpdate()->first();
                if ($lockedBook) {
                    $lockedBook->increment('stock');
                }
            });

            return redirect()->route('peminjam.borrowings.history')
                ->with('success', "Buku '{$borrowing->book->title}' telah berhasil dikembalikan. Terima kasih!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pengembalian buku: ' . $e->getMessage());
        }
    }

    public function history(Request $request): View
    {
        $userId = Auth::id();

        $query = Borrowing::with('book.category')
            ->where('user_id', $userId);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $borrowings = $query->latest('borrow_date')->paginate(10)->withQueryString();

        return view('peminjam.borrowings.history', compact('borrowings'));
    }
}
