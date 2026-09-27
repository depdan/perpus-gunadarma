<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak | Perpustakaan Universitas Gunadarma</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8FAFC] text-slate-800 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center bg-white p-8 sm:p-10 rounded-2xl border border-slate-200/80 shadow-xs">
        <div class="w-16 h-16 mx-auto rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-4 ring-8 ring-rose-50/60">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>

        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-rose-100 text-rose-700 mb-2">
            Status: 403 Forbidden
        </span>

        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mt-1">
            Akses Ditolak
        </h1>
        <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki izin akses administrator untuk membuka halaman ini.' }}
        </p>

        <div class="mt-6 pt-5 border-t border-slate-100 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('peminjam.catalog.index') }}"
               class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold inline-flex items-center justify-center space-x-2 shadow-royal-sm">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Kembali ke Katalog</span>
            </a>
        </div>
    </div>
</body>
</html>
