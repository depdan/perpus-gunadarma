<x-admin-layout>
    <x-slot name="headerTitle">
        Dashboard Utama Sirkulasi
    </x-slot>

    <x-flash-messages />

    <!-- Metric Statistic Cards (4-Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Metric 1: Total Buku -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Koleksi Buku</div>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $totalBooks ?? 0 }}</div>
                <div class="text-[11px] font-semibold text-royal-700 mt-1">Judul Terdaftar</div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-royal-50 text-royal-700 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>

        <!-- Metric 2: Total Anggota / Peminjam -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Anggota</div>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $totalBorrowers ?? 0 }}</div>
                <div class="text-[11px] font-semibold text-emerald-600 mt-1">Mahasiswa & Dosen</div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>

        <!-- Metric 3: Sedang Dipinjam -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Sedang Dipinjam</div>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $activeBorrowings ?? 0 }}</div>
                <div class="text-[11px] font-semibold text-royal-700 mt-1">Buku Beredar</div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-royal-100 text-royal-700 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
            </div>
        </div>

        <!-- Metric 4: Terlambat / Overdue -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400">Lewat Tenggat</div>
                <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $overdueBorrowings ?? 0 }}</div>
                <div class="text-[11px] font-semibold text-rose-600 mt-1">Perlu Tindak Lanjut</div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Content Section: Recent Transactions & Low Stock Alerts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Transactions (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col">
            <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-extrabold text-base text-slate-900">Transaksi Sirkulasi Terbaru</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Aktivitas peminjaman dan pengembalian buku terkini</p>
                </div>
                <a href="{{ route('admin.borrowings.index') }}" class="text-xs font-bold text-royal-700 hover:text-royal-800 transition">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="min-w-full divide-y divide-slate-100 text-left text-sm">
                    <thead class="bg-slate-50/70 text-slate-600 font-bold text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-5 py-3.5">Peminjam</th>
                            <th class="px-5 py-3.5">Buku</th>
                            <th class="px-5 py-3.5">Tgl Pinjam</th>
                            <th class="px-5 py-3.5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentTransactions ?? [] as $trans)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-5 py-3.5 whitespace-nowrap">
                                    <div class="font-bold text-xs text-slate-900">{{ $trans->user->name ?? 'User' }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $trans->user->email ?? '' }}</div>
                                </td>
                                <td class="px-5 py-3.5 whitespace-normal">
                                    <div class="font-bold text-xs text-slate-800 line-clamp-1">{{ $trans->book->title ?? 'Buku' }}</div>
                                    <div class="text-[10px] text-royal-700 font-semibold">{{ $trans->book->category->name ?? 'Umum' }}</div>
                                </td>
                                <td class="px-5 py-3.5 whitespace-nowrap text-xs text-slate-600 font-medium">
                                    {{ \Carbon\Carbon::parse($trans->borrow_date)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-5 py-3.5 whitespace-nowrap">
                                    @if($trans->status === 'returned')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Dikembalikan
                                        </span>
                                    @elseif(\Carbon\Carbon::parse($trans->due_date)->isPast())
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            Terlambat
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-royal-50 text-royal-700 border border-royal-200">
                                            Dipinjam
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-10 text-center text-xs text-slate-400">
                                    Belum ada transaksi peminjaman terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Low Stock Alerts (1 Col) -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-xs">
                <h3 class="font-extrabold text-base text-slate-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-2.5">
                    <a href="{{ route('admin.books.create') }}"
                       class="w-full btn-primary-royal py-3 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Tambah Buku Baru</span>
                    </a>

                    <a href="{{ route('admin.borrowings.index') }}"
                       class="w-full btn-soft-royal py-3 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Semua Transaksi</span>
                    </a>
                </div>
            </div>

            <!-- Low Stock Warnings -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-extrabold text-sm text-slate-900">Peringatan Stok Buku</h3>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 border border-rose-200">Kritis</span>
                </div>

                <div class="space-y-3">
                    @forelse($lowStockBooks ?? [] as $lowBook)
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/60 flex items-center justify-between">
                            <div class="min-w-0 pr-2">
                                <div class="font-bold text-xs text-slate-800 truncate">{{ $lowBook->title }}</div>
                                <div class="text-[10px] text-slate-400">{{ $lowBook->category->name ?? 'Umum' }}</div>
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-extrabold {{ $lowBook->stock == 0 ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-800' }} flex-shrink-0">
                                Sisa: {{ $lowBook->stock }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-6 text-xs text-slate-400">
                            Semua stok buku dalam kondisi aman.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
