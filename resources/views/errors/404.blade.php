<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Halaman Tidak Ditemukan | Perpustakaan Universitas Gunadarma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center bg-white p-8 sm:p-10 rounded-2xl border border-slate-200/80 shadow-xs">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-royal-50 text-royal-700 flex items-center justify-center mb-4 ring-8 ring-royal-50/60">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-royal-100 text-royal-700 mb-2">
            Status: 404 Not Found
        </span>

        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mt-1">
            Halaman Tidak Ditemukan
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
            Halaman atau data katalog yang Anda cari tidak tersedia atau tautan telah dipindahkan.
        </p>

        <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ url('/') }}"
               class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold inline-flex items-center justify-center space-x-2 shadow-royal-sm">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</body>
</html>
