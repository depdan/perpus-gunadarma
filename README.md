# Sistem Peminjaman Buku Perpustakaan Universitas Gunadarma
**Technical Test - Aptitude Test Universitas Gunadarma**

Aplikasi sistem peminjaman buku perpustakaan berbasis web yang dikembangkan menggunakan **Laravel 12, Blade Component, MySQL, Tailwind CSS, dan Vanilla JavaScript (AJAX)** dengan pemisahan hak akses berbasis peran (*Role-Based Access Control*), pencarian buku interaktif real-time (*Live Search*), serta integritas transaksi data peminjaman buku.

---

## 🚀 Fitur Utama & Kepatuhan Spesifikasi

### 1. Autentikasi & Otorisasi Berbasis Peran (RBAC)
- **Role Pengguna**: 
  - `admin` (Administrator Perpustakaan)
  - `peminjam` (Anggota Perpustakaan)
- **Pendaftaran Mandiri**: Pengguna yang mendaftar baru secara otomatis mendapatkan peran `peminjam`.
- **Akun Admin via Seeder**: Akun administrator diinisialisasi melalui database seeder (`AdminUserSeeder`).
- **Proteksi Backend Ketat**: Akses halaman admin dilindungi di tingkat middleware server (`RoleMiddleware`), sehingga pengguna berstatus peminjam yang mencoba mengakses URL `/admin/*` secara langsung akan ditolak dengan respons `403 Forbidden`.

### 2. Modul Admin (Kelola Buku & Monitor Transaksi)
- **Kelola Buku (CRUD)**: Menambah, mengubah, melihat, dan menghapus buku dengan validasi server-side (`StoreBookRequest`, `UpdateBookRequest`). Field mencakup Judul, Penulis, Kategori, dan Stok.
- **Monitoring Transaksi**: Menampilkan seluruh sirkulasi peminjaman aktif dan riwayat pengembalian dari seluruh anggota.
- **Dashboard Statistik**: Metrik real-time total buku, eksemplar stok, peminjaman berjalan, serta peringatan stok buku menipis.

### 3. Modul Peminjam (Katalog & Riwayat Transaksi)
- **Pencarian Langsung (Live Search AJAX)**: Fitur pencarian buku real-time tanpa memuat ulang halaman (*no page reload*) dengan teknik *debouncing (300ms)* via Fetch API.
- **Peminjaman Buku Transaksional**: Peminjaman otomatis memotong stok buku menggunakan `DB::transaction()` dan *pessimistic locking* (`lockForUpdate`). Buku dengan stok `0` dinonaktifkan di tampilan dan divalidasi ketat di sisi backend agar tidak dapat dipinjam.
- **Pengembalian Buku**: Mengembalikan buku memperbarui status transaksi menjadi `dikembalikan`, mencatat tanggal pengembalian, dan menambah kembali stok buku secara otomatis.
- **Isolasi Data Riwayat**: Peminjam hanya dapat melihat riwayat peminjaman miliknya sendiri (*data scoping*).

---

## 🛠️ Stack Teknologi

- **Backend Framework**: Laravel 12 (PHP 8.2+)
- **Template Engine**: Laravel Blade (Komponen modular & DRY)
- **Database**: MySQL (Engine InnoDB dengan Foreign Key Constraints)
- **Frontend & Styling**: Tailwind CSS & Vite
- **Interactivity**: Vanilla JavaScript (Fetch API & DOM Manipulation)
- **Authentication Starter**: Laravel Breeze (Blade Stack)

---

## 🔑 Kredensial Akun Demo

| Peran | Alamat Email | Kata Sandi | Akses Route |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@gunadarma.ac.id` | `password` | `/admin/dashboard` |
| **Peminjam** | `depdan@gunadarma.ac.id` | `password` | `/katalog` |

> *Catatan: Anda juga dapat membuat akun baru melalui halaman Registrasi (`/register`), yang secara otomatis akan mendapatkan peran sebagai Peminjam.*

---

## ⚙️ Panduan Instalasi Lokal

### 1. Prasyarat Sistem
- PHP >= 8.2 (dengan ekstensi `pdo_mysql`, `intl`, `zip`, `fileinfo`)
- Composer >= 2.x
- MySQL Server (XAMPP / Standalone)
- Node.js & NPM (Opsional untuk compile asset Vite)

### 2. Clone Repository
```bash
git clone <URL_REPOSITORY_ANDA>
cd Perpus
```

### 3. Instalasi Dependensi PHP & Frontend
```bash
composer install
npm install
npm run build
```

### 4. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Pastikan pengaturan database di file `.env` sudah sesuai:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus_gunadarma
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Jalankan Migrasi & Seeder Database
Jalankan migrasi beserta seluruh data seeder (termasuk pembuatan akun admin default, kategori, dan koleksi buku):
```bash
php artisan migrate:fresh --seed
```

Jika ingin menjalankan seeder akun admin secara spesifik:
```bash
php artisan db:seed --class=AdminUserSeeder
```

### 7. Jalankan Local Development Server
```bash
php artisan serve
```
Akses aplikasi melalui browser di: `http://localhost:8000`

---

## 🧪 Menjalankan Automated Test Suite

Aplikasi telah dilengkapi unit & feature test komprehensif untuk memverifikasi seluruh kriteria penilaian:
```bash
php artisan test --filter=LibrarySystemTest
```

**Skenario yang diuji:**
1. `test_peminjam_cannot_access_admin_dashboard_url` (Memverifikasi pembatasan URL admin return 403)
2. `test_peminjam_cannot_access_admin_books_crud_url` (Memverifikasi pembatasan route CRUD buku)
3. `test_admin_can_access_admin_dashboard` (Akses sah administrator)
4. `test_admin_can_create_new_book` (CRUD buku admin)
5. `test_peminjam_can_borrow_book_with_stock_and_decrements_stock` (Pengurangan stok otomatis)
6. `test_peminjam_cannot_borrow_book_with_zero_stock` (Validasi penolakan stok 0 di backend)
7. `test_peminjam_can_return_borrowed_book_and_increments_stock` (Penambahan stok saat pengembalian)
8. `test_peminjam_cannot_see_other_users_borrowing_history` (Isolasi riwayat antar pengguna)
9. `test_live_search_ajax_returns_json_with_html` (Fitur Live Search AJAX)

---

## 📌 Catatan & Kendala Selama Pengerjaan

1. **Konsistensi Race Condition pada Stok Buku**:
   - *Tantangan*: Jika dua peminjam menekan tombol pinjam secara bersamaan pada buku yang tersisa 1 stok, terdapat risiko stok menjadi minus.
   - *Solusi*: Menggunakan `DB::transaction()` yang dikombinasikan dengan `lockForUpdate()` di `BorrowingController` sehingga baris data buku terkunci selama proses validasi dan pengurangan stok.

2. **Performa Pencarian AJAX (Live Search)**:
   - *Tantangan*: Request yang terlalu sering ke server pada setiap ketukan keyboard (*keystroke*) dapat membebani server.
   - *Solusi*: Mengimplementasikan fungsi *debounce* 300ms pada event listener JavaScript murni (Vanilla JS) sebelum request AJAX dieksekusi.

3. **Keamanan & Otorisasi Backend**:
   - *Solusi*: Diterapkan `RoleMiddleware` khusus yang memeriksa peran sesi aktif pada level kernel sebelum controller dieksekusi.
