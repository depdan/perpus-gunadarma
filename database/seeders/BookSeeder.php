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
            // ==================== 💻 TEKNOLOGI & INFORMATIKA ====================
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'stock' => 5,
                'description' => 'Panduan komprehensif penulisan kode bersih, refactoring, dan best practices software engineering modern.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Teknologi Cloud Computing Modern & Arsitektur Mikroservis',
                'author' => 'Martin Fowler & Thomas Erl',
                'stock' => 5,
                'description' => 'Arsitektur cloud computing, distributed systems, Kubernetes, dan skalabilitas infrastruktur web.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Fundamental Data Science, Machine Learning & AI Terapan',
                'author' => 'Andrew Ng & Aurélien Géron',
                'stock' => 6,
                'description' => 'Pembahasan mendalam model machine learning, neural network, dan analisis dataset berbasis Python.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Desain Algoritma, Struktur Data & Optimasi Kompleksitas',
                'author' => 'Thomas H. Cormen',
                'stock' => 4,
                'description' => 'Analisis efisiensi algoritma graf, dynamic programming, binary search tree, dan rekursi.',
            ],
            [
                'category_id' => $tech?->id ?? 1,
                'title' => 'Keamanan Jaringan Komputer, Ethical Hacking & Kriptografi',
                'author' => 'William Stallings',
                'stock' => 3,
                'description' => 'Prinsip pertahanan siber, protokol enkripsi data, deteksi intrusi, dan keamanan infrastruktur.',
            ],

            // ==================== 📖 SASTRA & FIKSI (NOVEL TERPOPULER) ====================
            [
                'category_id' => $literature?->id ?? 5,
                'title' => 'Bumi Manusia: Tetralogi Buru',
                'author' => 'Pramoedya Ananta Toer',
                'stock' => 5,
                'description' => 'Mahakarya sastra legendaris Indonesia tentang kisah perjuangan Minke, Annelies, dan Nyai Ontosoroh melawan feodalisme dan kolonialisme.',
            ],
            [
                'category_id' => $literature?->id ?? 5,
                'title' => 'Laskar Pelangi: Novel Inspirasi Pendidikan Bangsa',
                'author' => 'Andrea Hirata',
                'stock' => 6,
                'description' => 'Kisah inspiratif tentang tekad 10 anak Belitung yang gigih memperjuangkan mimpi dan cita-cita meski dalam keterbatasan.',
            ],
            [
                'category_id' => $literature?->id ?? 5,
                'title' => 'Cantik Itu Luka: Epik Realisme Magis Nusantara',
                'author' => 'Eka Kurniawan',
                'stock' => 4,
                'description' => 'Kisah epik perpaduan sejarah kelam, mitologi, satire, dan drama tragedi keluarga Dewi Ayu di kota fiksi Halimunda.',
            ],
            [
                'category_id' => $literature?->id ?? 5,
                'title' => 'Pulang: Perjalanan Menemukan Makna Kehidupan',
                'author' => 'Tere Liye',
                'stock' => 5,
                'description' => 'Kisah aksi petualangan menegangkan tentang Bujang/Si Babi Hutan dalam memahami arti keberanian, pengkhianatan, dan kepulangan sejati.',
            ],
            [
                'category_id' => $literature?->id ?? 5,
                'title' => 'Negeri 5 Menara: Man Jadda Wajada',
                'author' => 'Ahmad Fuadi',
                'stock' => 4,
                'description' => 'Perjalanan 6 santri dari berbagai pelosok nusantara dengan mantra ajaib "Man Jadda Wajada" yang membawa mereka menjelajah dunia.',
            ],
            [
                'category_id' => $literature?->id ?? 5,
                'title' => '1984: Distopia dan Pengawasan Totaliter',
                'author' => 'George Orwell',
                'stock' => 3,
                'description' => 'Novel fiksi distopia klasik tentang dunia yang diawasi oleh Big Brother, propaganda bahasa, dan hilangnya kebebasan individu.',
            ],
            [
                'category_id' => $literature?->id ?? 5,
                'title' => 'Gadis Kretek: Aroma Cinta dan Sejarah Industri Tembakau',
                'author' => 'Ratih Kumala',
                'stock' => 4,
                'description' => 'Pencarian jejak Jeng Yah yang mengungkap kisah cinta segitiga dan persaingan bisnis pabrik kretek legendaris di tanah Jawa.',
            ],

            // ==================== 📈 BISNIS & MANAJEMEN ====================
            [
                'category_id' => $business?->id ?? 3,
                'title' => 'The Lean Startup: Inovasi Bisnis di Era Digital',
                'author' => 'Eric Ries',
                'stock' => 5,
                'description' => 'Metodologi validasi produk, MVP (Minimum Viable Product), dan agile feedback loop untuk membangun bisnis yang adaptif.',
            ],
            [
                'category_id' => $business?->id ?? 3,
                'title' => 'Good to Great: Mengapa Beberapa Perusahaan Melompat Maju',
                'author' => 'Jim Collins',
                'stock' => 4,
                'description' => 'Studi komprehensif tentang kepemimpinan level 5 dan strategi yang mengubah perusahaan rata-rata menjadi luar biasa.',
            ],
            [
                'category_id' => $business?->id ?? 3,
                'title' => 'Psikologi Uang (The Psychology of Money)',
                'author' => 'Morgan Housel',
                'stock' => 6,
                'description' => 'Pelajaran abadi tentang kekayaan, ketamakan, pengambilan keputusan investasi, dan perilaku manusia terhadap uang.',
            ],
            [
                'category_id' => $business?->id ?? 3,
                'title' => 'Zero to One: Catatan tentang Startup dan Membangun Masa Depan',
                'author' => 'Peter Thiel',
                'stock' => 4,
                'description' => 'Filosofi menciptakan inovasi baru yang benar-benar orisinal dari ketiadaan menjadi sesuatu yang mendominasi pasar.',
            ],

            // ==================== 🎨 DESAIN & SENI ====================
            [
                'category_id' => $design?->id ?? 4,
                'title' => 'Don\'t Make Me Think: Revolusi UI/UX Web Design',
                'author' => 'Steve Krug',
                'stock' => 4,
                'description' => 'Prinsip desain antarmuka pengguna yang intuitif, navigasi website yang jelas, dan usability testing praktis.',
            ],
            [
                'category_id' => $design?->id ?? 4,
                'title' => 'The Design of Everyday Things: Psikologi Desain Produk',
                'author' => 'Don Norman',
                'stock' => 4,
                'description' => 'Eksplorasi affordance, signifiers, dan desain produk yang memudahkan interaksi alami manusia.',
            ],
            [
                'category_id' => $design?->id ?? 4,
                'title' => 'Tipografi & Desain Komunikasi Visual Terapan',
                'author' => 'Ellen Lupton',
                'stock' => 3,
                'description' => 'Panduan tata huruf, grid system, teori warna, dan komposisi visual grafis profesional.',
            ],

            // ==================== 🔬 SAINS & MATEMATIKA ====================
            [
                'category_id' => $science?->id ?? 2,
                'title' => 'Kalkulus Terapan, Diferensial & Analisis Vektor',
                'author' => 'Prof. Dr. Suryadi & James Stewart',
                'stock' => 6,
                'description' => 'Fondasi kalkulus diferensial, integral multivariabel, dan penerapannya dalam komputasi rekayasa informatika.',
            ],
            [
                'category_id' => $science?->id ?? 2,
                'title' => 'Fisika Modern, Termodinamika & Sains Material',
                'author' => 'David Halliday & Robert Resnick',
                'stock' => 5,
                'description' => 'Konsep gelombang elektromagnetik, relativitas khusus, mekanika kuantum, dan fisika komputasi.',
            ],
            [
                'category_id' => $science?->id ?? 2,
                'title' => 'Statistika Terapan & Probabilitas untuk Pengambilan Keputusan',
                'author' => 'Ronald E. Walpole',
                'stock' => 4,
                'description' => 'Analisis regresi, uji hipotesis, distribusi probabilitas, dan inferensi statistik berbasis data empiris.',
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
