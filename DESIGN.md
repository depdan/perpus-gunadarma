# Design Direction: Perpustakaan Universitas Gunadarma

## Identity & Purpose
- **Nama Sistem**: Sistem Informasi & Sirkulasi Perpustakaan Universitas Gunadarma
- **Fungsi Utama**: Manajemen katalog buku, sirkulasi peminjaman mandiri mahasiswa, monitoring pengembalian, dan administrasi koleksi buku secara terstruktur dan efisien.
- **Audiens**: Mahasiswa, Dosen, Tenaga Pendidik, serta Staf Administrator Perpustakaan.

## Visual Language & Dials
- **Dials**: `ENERGY 2 / RHYTHM 2 / MOTION 1`
  - *Energy 2 (Balanced)*: Tampilan bersih, kredibel, dan profesional untuk institusi akademik universitas.
  - *Rhythm 2 (Structured & Varied)*: Hierarki visual terbagi rapi antara metrik statistik sirkulasi, tabel data responsif, filter pencarian live AJAX, dan modal konfirmasi aksi.
  - *Motion 1 (Subtle & Snappy)*: Transisi hover cepat (200ms cubic-bezier), animasi modal yang halus tanpa efek dekoratif berlebihan.

## Palette & Colors (R-29: max 2-3 core + 1 accent)
- **Primary Brand**: Gunadarma Royal Blue `#1E65DE` (hover `#1557BF`, background tint `#E8F0FE` / `#F0F6FE`)
- **Typography & Neutral Dark**: Slate-900 `#0F172A`, Slate-800 `#1E293B`, Slate-600 `#475569`, Slate-400 `#94A3B8`
- **Background & Canvas**: Slate-50 `#F8FAFC`, Surface White `#FFFFFF`, Border `#E2E8F0`
- **Functional Status Colors**:
  - *Success / Tersedia / Dikembalikan*: Emerald-600 `#059669` (bg `#ECFDF5`, border `#A7F3D0`)
  - *Danger / Terlambat / Habis*: Rose-600 `#E11D48` (bg `#FEF2F2`, border `#FECACA`)
  - *Warning / Perhatian*: Amber-600 `#D97706` (bg `#FFFBEB`, border `#FDE68A`)

## Typography (R-06)
- **Font Family**: `Plus Jakarta Sans`, sans-serif
- **Alasan**: Font modern geometris dengan keterbacaan tinggi, sangat cocok untuk aplikasi data katalog dan dashboard berbahasa Indonesia.

## Layout & Components (R-05, R-11, R-12)
- **Border Radius**: Konsisten `rounded-xl` (12px) untuk kontrol dan `rounded-2xl` (16px) untuk kartu kontainer.
- **Shadow**: `shadow-xs` untuk resting state kartu data, `shadow-royal-sm` untuk primary call-to-action button.
- **Form Controls**: Input dan select menggunakan latar belakang `bg-slate-50`, border `border-slate-200`, dan fokus `ring-2 ring-royal-500` dengan latar belakang berubah menjadi putih (`bg-white`).
