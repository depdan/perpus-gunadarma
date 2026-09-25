<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowingMonitorController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Peminjam\BookCatalogController;
use App\Http\Controllers\Peminjam\BorrowingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('peminjam.catalog.index');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return Auth::user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('peminjam.catalog.index');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:peminjam,admin'])->group(function () {
    Route::get('/katalog', [BookCatalogController::class, 'index'])->name('peminjam.catalog.index');
    Route::get('/katalog/search', [BookCatalogController::class, 'search'])->name('peminjam.catalog.search');
    Route::post('/katalog/pinjam/{book}', [BorrowingController::class, 'borrow'])->name('peminjam.borrowings.borrow');
    Route::get('/riwayat-saya', [BorrowingController::class, 'history'])->name('peminjam.borrowings.history');
    Route::post('/riwayat-saya/kembalikan/{borrowing}', [BorrowingController::class, 'returnBook'])->name('peminjam.borrowings.return');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', AdminBookController::class)->except(['show']);
    Route::get('/transaksi', [BorrowingMonitorController::class, 'index'])->name('borrowings.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
