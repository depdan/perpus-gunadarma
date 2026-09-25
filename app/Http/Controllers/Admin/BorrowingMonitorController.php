<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BorrowingMonitorController extends Controller
{
    public function index(Request $request): View
    {
        $query = Borrowing::with(['user', 'book.category']);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uQ) use ($search) {
                    $uQ->where('name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('book', function ($bQ) use ($search) {
                    $bQ->where('title', 'like', "%{$search}%")
                       ->orWhere('author', 'like', "%{$search}%");
                });
            });
        }

        $borrowings = $query->latest()->paginate(10)->withQueryString();

        return view('admin.borrowings.index', compact('borrowings'));
    }
}
