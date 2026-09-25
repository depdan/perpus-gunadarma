<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} - {{ config('app.name', 'Perpustakaan Gunadarma') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-800 bg-slate-100/70" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">
        <!-- Sidebar for Admin -->
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 flex flex-col justify-between hidden md:flex">
            <div>
                <!-- Sidebar Brand -->
                <div class="h-16 px-6 flex items-center bg-slate-950 border-b border-slate-800">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-tr from-purple-700 to-indigo-600 flex items-center justify-center shadow">
                            <svg class="w-5 h-5 text-amber-300" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L1 7l11 5 9-4.09V17h2V7L12 2zm0 13l-7-3.18V17c0 3.87 3.13 7 7 7s7-3.13 7-7v-5.18L12 15z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="font-bold text-sm tracking-wider text-white">GUNADARMA</span>
                            <span class="block text-[9px] font-semibold tracking-widest text-slate-400 -mt-1">PERPUSTAKAAN</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.books.index') }}"
                       class="flex items-center px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.books.*') ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Kelola Buku
                    </a>

                    <a href="{{ route('admin.borrowings.index') }}"
                       class="flex items-center px-4 py-2.5 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.borrowings.*') ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        Monitor Transaksi
                    </a>
                </nav>
            </div>

            <!-- Bottom of Sidebar -->
            <div class="p-4 border-t border-slate-800 space-y-2">
                <a href="{{ route('peminjam.catalog.index') }}"
                   class="flex items-center px-4 py-2 rounded-lg text-xs font-semibold text-slate-300 hover:bg-slate-800 transition">
                    <svg class="w-4 h-4 mr-2 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Mode Peminjam
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 rounded-lg text-xs font-semibold text-rose-400 hover:bg-rose-950/40 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar (Log Out)
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-slate-200 px-4 sm:px-8 flex items-center justify-between shadow-2xs">
                <!-- Breadcrumbs -->
                <div class="flex items-center space-x-2 text-sm text-slate-500">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-purple-700">Home</a>
                    @if(isset($breadcrumb))
                        <span>/</span>
                        <span class="font-medium text-slate-800">{{ $breadcrumb }}</span>
                    @endif
                </div>

                <!-- Right profile -->
                <div class="flex items-center space-x-4">
                    <div class="hidden sm:flex items-center space-x-4 mr-2">
                        <a href="{{ route('peminjam.catalog.index') }}" class="text-xs font-semibold text-slate-600 hover:text-purple-700">Katalog</a>
                        <a href="{{ route('peminjam.borrowings.history') }}" class="text-xs font-semibold text-slate-600 hover:text-purple-700">Riwayat Saya</a>
                    </div>

                    <div class="flex items-center space-x-3 pl-4 border-l border-slate-200">
                        <div class="w-8 h-8 rounded-full bg-purple-900 text-amber-300 font-bold flex items-center justify-center text-xs shadow-xs">
                            AD
                        </div>
                        <div class="hidden sm:block text-left">
                            <div class="text-xs font-bold text-slate-800">{{ Auth::user()->name }}</div>
                            <div class="text-[10px] font-semibold text-purple-700 uppercase tracking-wider">Administrator</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-8">
                <div class="max-w-7xl mx-auto">
                    <x-flash-messages />
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
