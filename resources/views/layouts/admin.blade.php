<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan Gunadarma') }} - Panel Administrator</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="{ sidebarOpen: false }" class="font-sans antialiased bg-[#F8FAFC] text-slate-800 min-h-screen flex selection:bg-royal-700 selection:text-white">

        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden"
             style="display: none;"></div>

        <!-- Sidebar Navigation -->
        <aside :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200/80 min-h-screen flex flex-col justify-between p-6 flex-shrink-0 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">
            <div>
                <!-- Brand / Logo -->
                <div class="flex items-center justify-between pb-6 border-b border-slate-100">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-xl overflow-hidden flex items-center justify-center flex-shrink-0 bg-royal-50 border border-royal-200/70 p-1 shadow-xs group-hover:scale-105 transition">
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-full h-full object-contain rounded-lg">
                        </div>
                        <div class="flex flex-col text-left leading-tight">
                            <span class="font-extrabold text-sm tracking-wider text-slate-900 uppercase">GUNADARMA</span>
                            <span class="text-[10px] font-bold tracking-wider uppercase text-royal-700">PANEL SIRKULASI</span>
                        </div>
                    </a>

                    <!-- Close Button for Mobile -->
                    <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="mt-6 space-y-1.5">
                    <div class="px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-2">Menu Administrasi</div>

                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-royal-700 text-white shadow-royal-sm' : 'text-slate-600 hover:text-royal-700 hover:bg-royal-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-royal-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard Utama</span>
                    </a>

                    <!-- Kelola Buku -->
                    <a href="{{ route('admin.books.index') }}"
                       class="flex items-center px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all {{ request()->routeIs('admin.books.*') ? 'bg-royal-700 text-white shadow-royal-sm' : 'text-slate-600 hover:text-royal-700 hover:bg-royal-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.books.*') ? 'text-white' : 'text-royal-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Kelola Koleksi Buku</span>
                    </a>

                    <!-- Sirkulasi & Transaksi -->
                    <a href="{{ route('admin.borrowings.index') }}"
                       class="flex items-center px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold transition-all {{ request()->routeIs('admin.borrowings.*') ? 'bg-royal-700 text-white shadow-royal-sm' : 'text-slate-600 hover:text-royal-700 hover:bg-royal-50' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.borrowings.*') ? 'text-white' : 'text-royal-700' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        <span>Lihat Semua Peminjaman</span>
                    </a>

                    <div class="pt-5 px-3 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-2">Portal Peminjam</div>

                    <!-- Lihat Katalog Pengguna -->
                    <a href="{{ route('peminjam.catalog.index') }}"
                       class="flex items-center px-4 py-3 rounded-2xl text-xs sm:text-sm font-bold text-slate-600 hover:text-royal-700 hover:bg-royal-50 transition-all">
                        <svg class="w-5 h-5 mr-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>Lihat Portal Mahasiswa</span>
                    </a>
                </div>
            </div>

            <!-- Admin Profile Card & Logout -->
            <div class="pt-4 border-t border-slate-100">
                <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-xl bg-royal-700 text-white flex items-center justify-center font-extrabold text-xs flex-shrink-0 shadow-xs">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div class="min-w-0">
                            <div class="font-bold text-xs text-slate-900 truncate">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] text-royal-700 font-extrabold uppercase tracking-wider">Staff Admin</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Keluar" class="text-slate-400 hover:text-rose-600 p-1.5 rounded-xl hover:bg-rose-50 transition cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Admin Content Area -->
        <div class="flex-1 flex flex-col min-h-screen overflow-x-hidden">
            <!-- Top Header -->
            <header class="bg-white border-b border-slate-200/80 h-16 flex items-center justify-between px-6 sm:px-8 sticky top-0 z-30 shadow-xs">
                <div class="flex items-center space-x-3">
                    <!-- Hamburger button for mobile/tablet -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-xl text-slate-500 hover:text-royal-700 hover:bg-royal-50 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <h2 class="font-extrabold text-base sm:text-lg text-slate-900 tracking-tight">
                        {{ $headerTitle ?? 'Dashboard Perpustakaan' }}
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-xs font-semibold text-slate-500 hidden sm:inline">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                    <a href="{{ route('profile.edit') }}" class="text-xs font-bold text-slate-600 hover:text-royal-700 px-3.5 py-1.5 rounded-xl border border-slate-200 hover:bg-royal-50 transition shadow-xs">
                        Pengaturan Akun
                    </a>
                </div>
            </header>

            <!-- Page Body -->
            <main class="flex-1 p-6 sm:p-8 space-y-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
