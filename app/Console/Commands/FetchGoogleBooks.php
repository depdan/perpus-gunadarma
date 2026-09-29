<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FetchGoogleBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:fetch {--category= : Nama atau slug kategori spesifik} {--limit=5 : Jumlah buku per kategori} {--engine=openlibrary : Engine sumber API (openlibrary atau google)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengambil data buku nyata (Fiksi, Teknologi, Sains, Bisnis, Desain) dari OpenLibrary / Google Books API';

    /**
     * Mapping kategori ke kata kunci pencarian API
     */
    protected array $categoryQueries = [
        'sastra-fiksi' => [
            'name' => 'Sastra & Fiksi',
            'queries' => ['novel indonesia', 'pramoedya ananta toer', 'tere liye', 'andrea hirata', 'indonesian literature', 'fiction novel'],
        ],
        'teknologi' => [
            'name' => 'Teknologi',
            'queries' => ['laravel framework', 'clean code programming', 'machine learning python', 'cloud computing software engineering'],
        ],
        'bisnis-manajemen' => [
            'name' => 'Bisnis & Manajemen',
            'queries' => ['startup business indonesia', 'financial economics management', 'leadership strategy'],
        ],
        'desain-seni' => [
            'name' => 'Desain & Seni',
            'queries' => ['user interface design', 'typography visual graphic design', 'design thinking'],
        ],
        'sains-matematika' => [
            'name' => 'Sains & Matematika',
            'queries' => ['calculus mathematics', 'modern physics', 'probability and statistics data'],
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info("🚀 Memulai proses impor data buku dari live API (Fiksi & Akademik)...\n");

        $specificCategory = $this->option('category');
        $limit = (int) $this->option('limit');
        $engine = strtolower($this->option('engine'));

        $categoriesToProcess = $this->categoryQueries;
        if ($specificCategory) {
            $slug = Str::slug($specificCategory);
            if (isset($this->categoryQueries[$slug])) {
                $categoriesToProcess = [$slug => $this->categoryQueries[$slug]];
            } else {
                $this->error("Kategori '{$specificCategory}' tidak ditemukan dalam mapping.");
                return Command::FAILURE;
            }
        }

        $totalAdded = 0;

        foreach ($categoriesToProcess as $slug => $config) {
            $this->line("<fg=yellow>📚 Mengambil buku kategori: {$config['name']}...</>");

            // Pastikan kategori ada di database
            $category = Category::firstOrCreate(
                ['slug' => $slug],
                ['name' => $config['name']]
            );

            $addedInCat = 0;

            foreach ($config['queries'] as $query) {
                if ($addedInCat >= $limit) {
                    break;
                }

                try {
                    if ($engine === 'openlibrary') {
                        $response = Http::withoutVerifying()
                            ->withHeaders(['User-Agent' => 'PerpusGunadarmaApp/1.0'])
                            ->timeout(12)
                            ->get('https://openlibrary.org/search.json', [
                                'q' => $query,
                                'limit' => min(10, $limit - $addedInCat + 2),
                            ]);

                        if ($response->successful() && !empty($response->json('docs'))) {
                            foreach ($response->json('docs') as $doc) {
                                if ($addedInCat >= $limit) {
                                    break;
                                }

                                $title = trim($doc['title'] ?? '');
                                $authors = $doc['author_name'] ?? ['Penulis Anonim'];
                                $author = implode(', ', array_slice($authors, 0, 2));
                                $firstYear = $doc['first_publish_year'] ?? date('Y');
                                $coverId = $doc['cover_i'] ?? null;
                                $coverImage = $coverId ? "https://covers.openlibrary.org/b/id/{$coverId}-M.jpg" : null;

                                if (empty($title) || strlen($title) < 3) {
                                    continue;
                                }

                                $description = "Koleksi buku '{$title}' karya {$author} (Edisi {$firstYear}). Menyajikan materi referensi dan wawasan penting untuk studi dan literasi civitas akademika.";
                                $stock = rand(3, 7);

                                $book = Book::updateOrCreate(
                                    ['title' => Str::limit($title, 190)],
                                    [
                                        'category_id' => $category->id,
                                        'author' => Str::limit($author, 100),
                                        'description' => $description,
                                        'stock' => $stock,
                                        'cover_image' => $coverImage,
                                    ]
                                );

                                $this->line("  <fg=green>✓</> [{$category->name}] {$book->title} - {$book->author} (Stok: {$book->stock})");
                                $addedInCat++;
                                $totalAdded++;
                            }
                        }
                    } else {
                        // Fallback / Google Engine
                        $response = Http::withoutVerifying()
                            ->withHeaders(['User-Agent' => 'PerpusGunadarmaApp/1.0'])
                            ->timeout(10)
                            ->get('https://www.googleapis.com/books/v1/volumes', [
                                'q' => $query,
                                'maxResults' => min(10, $limit - $addedInCat),
                                'printType' => 'books',
                            ]);

                        if ($response->successful() && !empty($response->json('items'))) {
                            foreach ($response->json('items') as $item) {
                                if ($addedInCat >= $limit) {
                                    break;
                                }

                                $info = $item['volumeInfo'] ?? [];
                                $title = trim($info['title'] ?? '');
                                $authors = $info['authors'] ?? ['Penulis Anonim'];
                                $author = implode(', ', array_slice($authors, 0, 2));
                                $description = strip_tags($info['description'] ?? 'Buku literatur pilihan.');
                                $coverImage = $info['imageLinks']['thumbnail'] ?? null;

                                if (empty($title)) {
                                    continue;
                                }

                                $book = Book::updateOrCreate(
                                    ['title' => Str::limit($title, 190)],
                                    [
                                        'category_id' => $category->id,
                                        'author' => Str::limit($author, 100),
                                        'description' => Str::limit($description, 350),
                                        'stock' => rand(3, 7),
                                        'cover_image' => $coverImage ? preg_replace('/^http:/i', 'https:', $coverImage) : null,
                                    ]
                                );

                                $this->line("  <fg=green>✓</> [{$category->name}] {$book->title} - {$book->author}");
                                $addedInCat++;
                                $totalAdded++;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    $this->warn("  ⚠️ Gagal mengambil query '{$query}': " . $e->getMessage());
                }
            }

            $this->info("  Total ditambahkan untuk {$config['name']}: {$addedInCat} buku.\n");
        }

        $this->info("✨ Selesai! Berhasil memuat total {$totalAdded} buku ke database.\n");
        return Command::SUCCESS;
    }
}
