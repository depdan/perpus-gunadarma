<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookCatalogController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();
        $selectedCategory = $request->input('category');

        $query = Book::with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($catQ) use ($search) {
                      $catQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $books = $query->orderBy('title')->get();

        return view('peminjam.catalog.index', compact('books', 'categories', 'selectedCategory'));
    }

    public function search(Request $request)
    {
        $search = $request->input('q', '');
        $categorySlug = $request->input('category', '');

        $query = Book::with('category');

        if (!empty($categorySlug)) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($catQ) use ($search) {
                      $catQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $books = $query->orderBy('title')->get();

        if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'html' => view('peminjam.catalog.partials.book_grid', compact('books'))->render(),
                'count' => $books->count(),
            ]);
        }

        $categories = Category::orderBy('name')->get();
        $selectedCategory = $categorySlug;
        return view('peminjam.catalog.index', compact('books', 'categories', 'selectedCategory'));
    }
}
