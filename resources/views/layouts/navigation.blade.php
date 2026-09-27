<nav x-data="{ open: false }" class="bg-white border-b border-slate-200/80 sticky top-0 z-40 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Brand & Navigation Links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('peminjam.catalog.index') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl overflow-hidden flex items-center justify-center flex-shrink-0 bg-royal-50 border border-royal-200/60 p-1 shadow-xs transition-transform duration-200 group-hover:scale-105">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-full h-full object-contain rounded-lg">
                    </div>
                    <div class="flex flex-col text-left leading-tight">
                        <div class="flex items-center space-x-1.5">
                            <span class="font-extrabold text-sm tracking-wider text-slate-900 uppercase">GUNADARMA</span>
                            <span class="text-[9px] font-extrabold px-1.5 py-0.5 rounded-md bg-royal-700 text-white">LIB</span>
                        </div>
                        <span class="text-[10px] font-bold tracking-wider uppercase text-royal-700">PERPUSTAKAAN DIGITAL</span>
                    </div>
                </a>

                <!-- Desktop Navigation Tabs -->
                <div class="hidden sm:flex sm:space-x-2 sm:items-center sm:ms-4">
                    <a href="{{ route('peminjam.catalog.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition duration-150 {{ request()->routeIs('peminjam.catalog.*') ? 'bg-royal-50 text-royal-700 shadow-xs' : 'text-slate-600 hover:text-royal-700 hover:bg-slate-50' }}">
                        <svg class="w-4 h-4 mr-2 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        Katalog Buku
                    </a>

                    <a href="{{ route('peminjam.borrowings.history') }}"
                       class="inline-flex items-center px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition duration-150 {{ request()->routeIs('peminjam.borrowings.*') ? 'bg-royal-50 text-royal-700 shadow-xs' : 'text-slate-600 hover:text-royal-700 hover:bg-slate-50' }}">
                        <svg class="w-4 h-4 mr-2 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Riwayat Peminjaman
                    </a>

                    @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center px-3.5 py-1.5 ms-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-slate-900 text-white hover:bg-slate-800 transition shadow-xs">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-royal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Mode Admin
                        </a>
                    @endif
                </div>
            </div>

            <!-- Profile / Account Menu -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3.5 py-1.5 border border-slate-200 text-sm leading-4 font-semibold rounded-full text-slate-700 bg-white hover:bg-slate-50 focus:outline-none transition ease-in-out duration-150 shadow-xs">
                                <div class="w-7 h-7 rounded-full bg-royal-700 text-white flex items-center justify-center mr-2.5 font-extrabold text-xs uppercase shadow-2xs">
                                    {{ substr(Auth::user()->name, 0, 2) }}
                                </div>
                                <div class="font-bold text-slate-800">{{ Auth::user()->name }}</div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2.5 border-b border-slate-100 bg-slate-50/50">
                                <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Peran Pengguna</div>
                                <div class="font-bold text-royal-700 text-xs capitalize flex items-center mt-0.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block mr-1.5"></span>
                                    {{ Auth::user()->role === 'admin' ? 'Administrator Perpustakaan' : 'Anggota / Peminjam' }}
                                </div>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center text-xs font-semibold py-2.5">
                                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ __('Pengaturan Akun') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="flex items-center text-xs font-bold text-rose-600 hover:text-rose-700 py-2.5">
                                    <svg class="w-4 h-4 mr-2 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    {{ __('Keluar (Log Out)') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-xs font-bold text-slate-700 hover:text-royal-700 px-3 py-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary-royal text-xs font-bold px-4 py-2 rounded-xl">Daftar</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-royal-700 hover:bg-royal-50 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-slate-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('peminjam.catalog.index')" :active="request()->routeIs('peminjam.catalog.*')">
                {{ __('Katalog Buku') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('peminjam.borrowings.history')" :active="request()->routeIs('peminjam.borrowings.*')">
                {{ __('Riwayat Peminjaman') }}
            </x-responsive-nav-link>
            @if(Auth::check() && Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                    {{ __('Mode Admin') }}
                </x-responsive-nav-link>
            @endif
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-slate-200 px-4">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-full bg-royal-700 text-white flex items-center justify-center font-bold text-xs">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div>
                        <div class="font-bold text-sm text-slate-800">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Pengaturan Akun') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-rose-600">
                            {{ __('Keluar (Log Out)') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
