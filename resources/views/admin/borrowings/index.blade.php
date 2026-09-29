<x-admin-layout>
    <x-slot name="headerTitle">
        Lihat Semua Peminjaman
    </x-slot>

    <div class="space-y-6">
        <x-flash-messages />

        <!-- Header Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                    Seluruh Transaksi Peminjaman
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Rekapitulasi transaksi peminjaman, durasi masa pinjam, status ketepatan waktu, dan riwayat pengembalian seluruh anggota perpustakaan.
                </p>
            </div>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs">
            <form method="GET" action="{{ route('admin.borrowings.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama peminjam, email mahasiswa/dosen, atau judul buku..."
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:bg-white transition">
                </div>

                <div class="sm:w-60">
                    <select name="status"
                            onchange="this.form.submit()"
                            class="w-full py-2.5 px-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:bg-white transition cursor-pointer">
                        <option value="">Semua Status Transaksi</option>
                        <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Sedang Dipinjam (Aktif)</option>
                        <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                    </select>
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold cursor-pointer">
                        Filter
                    </button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.borrowings.index') }}"
                           class="px-4 py-2.5 bg-slate-100 text-slate-700 font-bold rounded-xl text-xs sm:text-sm hover:bg-slate-200 transition flex items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200/80 text-left text-sm">
                    <thead class="bg-slate-50/80 text-slate-700 font-bold text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Peminjam</th>
                            <th class="px-6 py-4">Judul Buku</th>
                            <th class="px-6 py-4">Tgl Pinjam & Durasi</th>
                            <th class="px-6 py-4">Tenggat / Tgl Kembali</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($borrowings as $b)
                            @php
                                $dueDate = \Carbon\Carbon::parse($b->due_date)->startOfDay();
                                $today = \Carbon\Carbon::now()->startOfDay();
                                $isOverdue = $b->status === 'dipinjam' && $dueDate->isPast();
                                $daysRemaining = (int) $today->diffInDays($dueDate, false);
                                $duration = $b->duration_days;
                            @endphp
                            <tr class="hover:bg-slate-50/60 transition group">
                                <td class="px-6 py-4 font-mono text-xs font-extrabold text-royal-700 text-center">
                                    {{ $borrowings->firstItem() ? ($loop->iteration + $borrowings->firstItem() - 1) : $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-royal-50 text-royal-700 font-extrabold text-xs flex items-center justify-center border border-royal-200/80">
                                            {{ strtoupper(substr($b->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-extrabold text-slate-900 text-xs sm:text-sm group-hover:text-royal-700 transition">
                                                {{ $b->user->name ?? 'User Terhapus' }}
                                            </div>
                                            <span class="block text-[11px] text-slate-400">{{ $b->user->email ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-normal">
                                    <div class="font-bold text-xs sm:text-sm text-slate-800 line-clamp-1">{{ $b->book->title ?? 'Buku Terhapus' }}</div>
                                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold border {{ $b->book->category?->badge_class ?? 'text-royal-700 bg-royal-50 border-royal-200/60' }} mt-0.5">{{ $b->book->category->name ?? 'Umum' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-slate-800 font-bold">
                                        {{ \Carbon\Carbon::parse($b->borrow_date)->translatedFormat('d M Y') }}
                                    </div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200 mt-1">
                                        {{ $duration }} Hari
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    @if($b->status === 'dikembalikan')
                                        <span class="text-emerald-700 font-bold">
                                            Kembali: {{ \Carbon\Carbon::parse($b->return_date)->translatedFormat('d M Y') }}
                                        </span>
                                    @else
                                        <span class="font-bold {{ $isOverdue ? 'text-rose-600' : 'text-slate-800' }}">
                                            Tenggat: {{ \Carbon\Carbon::parse($b->due_date)->translatedFormat('d M Y') }}
                                        </span>
                                        @if($isOverdue)
                                            <div class="text-[10px] text-rose-600 font-bold mt-0.5">Lewat {{ abs($daysRemaining) }} hari!</div>
                                        @elseif($daysRemaining == 0)
                                            <div class="text-[10px] text-amber-600 font-bold mt-0.5">Tenggat hari ini!</div>
                                        @else
                                            <div class="text-[10px] text-slate-400 mt-0.5">Sisa {{ $daysRemaining }} hari</div>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($b->status === 'dikembalikan')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                            Dikembalikan
                                        </span>
                                    @elseif($isOverdue)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200 shadow-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5 animate-ping"></span>
                                            Terlambat
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-royal-50 text-royal-700 border border-royal-200 shadow-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-royal-700 mr-1.5 animate-pulse"></span>
                                            Sedang Dipinjam
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400 text-sm">
                                    Tidak ada data transaksi peminjaman buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($borrowings->hasPages())
                <div class="px-6 py-4 border-t border-slate-200/80 bg-slate-50/50">
                    {{ $borrowings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
