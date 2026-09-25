<x-admin-layout>
    <x-slot name="breadcrumb">Dashboard</x-slot>

    <div class="space-y-6">
        <!-- Header banner -->
        <div class="bg-gradient-to-r from-purple-900 via-indigo-900 to-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-400/20 text-amber-300 border border-amber-400/30 mb-3">
                    Panel Administrator
                </span>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h1>
                <p class="text-slate-300 text-sm mt-2">
                    Kelola koleksi perpustakaan, pantau sirkulasi peminjaman buku, dan awasi ketersediaan stok secara real-time.
                </p>
            </div>
            <div class="absolute -right-8 -bottom-8 opacity-10 text-white pointer-events-none hidden lg:block">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L1 7l11 5 9-4.09V17h2V7L12 2zm0 13l-7-3.18V17c0 3.87 3.13 7 7 7s7-3.13 7-7v-5.18L12 15z"/>
                </svg>
            </div>
        </div>

        <!-- Metric Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Judul Buku -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Judul Buku</p>
                    <p class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalBooks }}</p>
                    <p class="text-[11px] text-slate-500 mt-1">Koleksi terdaftar</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <!-- Total Eksemplar Stok -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Eksemplar Stok</p>
                    <p class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalStock }}</p>
                    <p class="text-[11px] text-emerald-600 font-semibold mt-1">Siap disirkulasikan</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>

            <!-- Peminjaman Aktif -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Peminjaman Aktif</p>
                    <p class="text-2xl font-extrabold text-blue-600 mt-1">{{ $activeBorrowings }}</p>
                    <p class="text-[11px] text-blue-500 font-medium mt-1">Sedang dipinjam anggota</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <!-- Total Anggota Peminjam -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Anggota</p>
                    <p class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalMembers }}</p>
                    <p class="text-[11px] text-slate-500 mt-1">Peminjam terdaftar</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Tables section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Transactions (2 cols) -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="font-bold text-base text-slate-900">Transaksi Peminjaman Terbaru</h2>
                        <p class="text-xs text-slate-500">Aktivitas peminjaman dan pengembalian terakhir</p>
                    </div>
                    <a href="{{ route('admin.borrowings.index') }}" class="text-xs font-bold text-purple-700 hover:text-purple-900">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="text-slate-400 font-bold uppercase tracking-wider border-b border-slate-100">
                                <th class="pb-2">Peminjam</th>
                                <th class="pb-2">Judul Buku</th>
                                <th class="pb-2">Tgl Pinjam</th>
                                <th class="pb-2">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentBorrowings as $row)
                                <tr>
                                    <td class="py-3 font-semibold text-slate-800">{{ $row->user->name ?? 'User' }}</td>
                                    <td class="py-3 text-slate-600 truncate max-w-xs">{{ $row->book->title ?? '-' }}</td>
                                    <td class="py-3 text-slate-500">{{ \Carbon\Carbon::parse($row->borrow_date)->format('d M Y') }}</td>
                                    <td class="py-3">
                                        @if($row->status === 'dipinjam')
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-500 text-white">Dipinjam</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800">Kembali</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-slate-400">Belum ada transaksi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Low Stock Warnings (1 col) -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="font-bold text-base text-slate-900">Peringatan Stok Buku</h2>
                        <p class="text-xs text-slate-500">Stok menipis atau kosong</p>
                    </div>
                </div>

                <div class="mt-4 space-y-3">
                    @forelse($lowStockBooks as $b)
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70 flex items-center justify-between">
                            <div class="min-w-0 flex-1 pr-2">
                                <p class="text-xs font-bold text-slate-900 truncate">{{ $b->title }}</p>
                                <p class="text-[11px] text-slate-500">{{ $b->author }}</p>
                            </div>
                            <span class="px-2 py-1 rounded-md text-xs font-extrabold {{ $b->stock == 0 ? 'bg-rose-100 text-rose-800' : 'bg-amber-100 text-amber-800' }}">
                                Stok: {{ $b->stock }}
                            </span>
                        </div>
                    @empty
                        <p class="py-6 text-center text-xs text-slate-400">Semua stok buku dalam batas aman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
