<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan Universitas Gunadarma') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] text-slate-800 min-h-screen flex flex-col selection:bg-royal-700 selection:text-white">
        <div class="min-h-screen flex flex-col">
            <!-- Global Top Navigation Bar -->
            @include('layouts.navigation')

            <!-- Page Heading (if provided) -->
            @isset($header)
                <header class="bg-white border-b border-slate-200/80 shadow-xs">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Academic Footer -->
            <footer class="bg-white border-t border-slate-200/80 py-6 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 font-medium">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-lg bg-royal-700 text-white flex items-center justify-center font-extrabold text-[10px]">
                            UG
                        </div>
                        <span>&copy; {{ date('Y') }} Perpustakaan Universitas Gunadarma. Seluruh Hak Cipta Dilindungi.</span>
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('peminjam.catalog.index') }}" class="hover:text-royal-700 transition">Katalog</a>
                        <a href="{{ route('peminjam.borrowings.history') }}" class="hover:text-royal-700 transition">Riwayat Peminjaman</a>
                        <span class="text-slate-300">|</span>
                        <span class="text-slate-400">Sistem Informasi Sirkulasi Digital</span>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
