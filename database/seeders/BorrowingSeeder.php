<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Database\Seeder;

class BorrowingSeeder extends Seeder
{
    public function run(): void
    {
        $depdan = User::where('email', 'depdan@gunadarma.ac.id')->first();
        if (!$depdan) {
            return;
        }

        $cleanCode = Book::where('title', 'like', '%Clean Code%')->first();
        $techBook = Book::where('title', 'like', '%Teknologi Cloud%')->first();
        $cyberBook = Book::where('title', 'like', '%Pemadam Hitam%')->first();

        if ($cleanCode) {
            Borrowing::updateOrCreate(
                [
                    'user_id' => $depdan->id,
                    'book_id' => $cleanCode->id,
                    'status' => 'dipinjam',
                ],
                [
                    'borrow_date' => now()->subDays(5)->toDateString(),
                    'due_date' => now()->addDays(9)->toDateString(),
                    'return_date' => null,
                    'notes' => 'Peminjaman untuk referensi tugas akhir',
                ]
            );
        }

        if ($techBook) {
            Borrowing::updateOrCreate(
                [
                    'user_id' => $depdan->id,
                    'book_id' => $techBook->id,
                    'status' => 'dikembalikan',
                ],
                [
                    'borrow_date' => now()->subDays(20)->toDateString(),
                    'due_date' => now()->subDays(6)->toDateString(),
                    'return_date' => now()->subDays(7)->toDateString(),
                    'notes' => 'Tepat waktu',
                ]
            );
        }

        if ($cyberBook) {
            Borrowing::updateOrCreate(
                [
                    'user_id' => $depdan->id,
                    'book_id' => $cyberBook->id,
                    'status' => 'dikembalikan',
                ],
                [
                    'borrow_date' => now()->subDays(15)->toDateString(),
                    'due_date' => now()->subDays(1)->toDateString(),
                    'return_date' => now()->subDays(2)->toDateString(),
                    'notes' => 'Kondisi buku baik',
                ]
            );
        }
    }
}
