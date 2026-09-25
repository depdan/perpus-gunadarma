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
        $totalStock = Book::sum('stock');
        $activeBorrowings = Borrowing::where('status', 'dipinjam')->count();
        $returnedBorrowings = Borrowing::where('status', 'dikembalikan')->count();
        $totalMembers = User::where('role', 'peminjam')->count();

        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        $lowStockBooks = Book::where('stock', '<=', 2)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalStock',
            'activeBorrowings',
            'returnedBorrowings',
            'totalMembers',
            'recentBorrowings',
            'lowStockBooks'
        ));
    }
}
