<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBooks = Book::count();
        $totalStock = (int) Book::sum('stock');
        $activeBorrowings = Borrowing::where('status', 'dipinjam')->count();
        $returnedBorrowings = Borrowing::where('status', 'dikembalikan')->count();
        $overdueBorrowings = Borrowing::where('status', 'dipinjam')
            ->whereDate('due_date', '<', now()->toDateString())
            ->count();
        $totalMembers = User::where('role', 'peminjam')->count();
        $totalBorrowers = $totalMembers;

        $recentTransactions = Borrowing::with(['user', 'book.category'])
            ->latest()
            ->take(5)
            ->get();
        $recentBorrowings = $recentTransactions;

        $lowStockBooks = Book::with('category')
            ->where('stock', '<=', 2)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalStock',
            'activeBorrowings',
            'returnedBorrowings',
            'overdueBorrowings',
            'totalMembers',
            'totalBorrowers',
            'recentTransactions',
            'recentBorrowings',
            'lowStockBooks'
        ));
    }

    public function stats(): \Illuminate\Http\JsonResponse
    {
        $totalBooks = Book::count();
        $totalStock = (int) Book::sum('stock');
        $activeBorrowings = Borrowing::where('status', 'dipinjam')->count();
        $returnedBorrowings = Borrowing::where('status', 'dikembalikan')->count();
        $overdueBorrowings = Borrowing::where('status', 'dipinjam')
            ->whereDate('due_date', '<', now()->toDateString())
            ->count();
        $totalMembers = User::where('role', 'peminjam')->count();

        $recentTransactions = Borrowing::with(['user', 'book.category'])
            ->latest()
            ->take(5)
            ->get();

        $lowStockBooks = Book::with('category')
            ->where('stock', '<=', 2)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return response()->json([
            'status' => 'success',
            'total_books' => $totalBooks,
            'total_stock' => $totalStock,
            'total_members' => $totalMembers,
            'active_borrowings' => $activeBorrowings,
            'returned_borrowings' => $returnedBorrowings,
            'overdue_borrowings' => $overdueBorrowings,
            'recent_transactions_html' => view('admin.dashboard_partials.recent_transactions_rows', [
                'recentTransactions' => $recentTransactions
            ])->render(),
            'low_stock_html' => view('admin.dashboard_partials.low_stock_items', [
                'lowStockBooks' => $lowStockBooks
            ])->render(),
            'updated_at' => now()->translatedFormat('H:i:s'),
        ]);
    }
}
