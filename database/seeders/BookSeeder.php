<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $tech = Category::where('name', 'Teknologi')->first();
        $science = Category::where('name', 'Sains & Matematika')->first();
        $business = Category::where('name', 'Bisnis & Manajemen')->first();
        $design = Category::where('name', 'Desain & Seni')->first();
        $literature = Category::where('name', 'Sastra & Fiksi')->first();

        $books = [
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'stock' => 5,
                'description' => 'Panduan komprehensif penulisan kode bersih, refactoring, dan best practices software engineering.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Teknologi Cloud Computing Modern',
                'author' => 'Robert C. Martin',
                'stock' => 5,
                'description' => 'Arsitektur cloud computing, mikroservis, dan skalabilitas infrastruktur modern.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Dutm Books - Panduan Dasar Pemrograman Web',
                'author' => 'Robert C. Martin',
                'stock' => 0,
                'description' => 'Buku pengantar HTML, CSS, JavaScript, dan backend Laravel untuk pemula (Stok Habis).',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Conedawrite: Fundamental Data Science & AI',
                'author' => 'Robert C. Martin',
                'stock' => 5,
                'description' => 'Pembahasan machine learning, deep learning, dan pengolahan dataset besar.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Coas: Rekayasa Perangkat Lunak Terapan',
                'author' => 'Robert C. Martin',
                'stock' => 5,
                'description' => 'Metodologi agile, scrum, CI/CD, dan manajemen lifecycle software.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Dleak Raman: Desain Algoritma dan Struktur Data',
                'author' => 'Robert C. Martin',
                'stock' => 5,
                'description' => 'Analisis kompleksitas waktu, binary search tree, graph, dan dynamic programming.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Perpustakaan Set dari Teknologi Informasi',
                'author' => 'Robert C. Martin',
                'stock' => 4,
                'description' => 'Kompilasi panduan sistem informasi dan manajemen database relasional.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Pemadam Hitam dan Teknologi',
                'author' => 'Budi Sudarsono',
                'stock' => 3,
                'description' => 'Analisis keamanan siber, pertahanan jaringan komputer, dan enkripsi data.',
            ],
            [
                'category_id' => $business?->id ?? 1,
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'stock' => 4,
                'description' => 'Inovasi berkelanjutan untuk menciptakan bisnis yang sukses dan adaptif.',
            ],
            [
                'category_id' => $design?->id ?? 1,
                'title' => 'Don\'t Make Me Think: Revolusi UI/UX Design',
                'author' => 'Steve Krug',
                'stock' => 2,
                'description' => 'Prinsip desain pengalaman pengguna (UX) yang intuitif dan mudah dipahami.',
            ],
        ];

        foreach ($books as $b) {
            Book::updateOrCreate(
                ['title' => $b['title']],
                $b
            );
        }
    }
}
