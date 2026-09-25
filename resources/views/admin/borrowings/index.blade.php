<x-admin-layout>
    <x-slot name="breadcrumb">Monitor Transaksi</x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-slate-100 gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                        Semua Transaksi Peminjaman
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Pantau seluruh sirkulasi peminjaman dan pengembalian buku dari semua anggota.
                    </p>
                </div>
            </div>

            <!-- Filters -->
            <form method="GET" action="{{ route('admin.borrowings.index') }}" class="mt-6 flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama peminjam atau judul buku..."
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
                </div>

                <div class="sm:w-48">
                    <select name="status"
                            onchange="this.form.submit()"
                            class="w-full py-2.5 px-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" {{ request('status') === 'dipinjam' ? 'selected' : '' }}>Dipinjam (Aktif)</option>
                        <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="px-4 py-2.5 bg-purple-900 text-white font-semibold rounded-xl text-sm hover:bg-purple-800 transition">
                        Filter
                    </button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.borrowings.index') }}"
                           class="px-4 py-2.5 bg-slate-100 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-200 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <!-- Table -->
            <div class="mt-6 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider bg-slate-50/60">
                            <th class="py-3.5 px-4 rounded-l-xl w-16">ID</th>
                            <th class="py-3.5 px-4">Peminjam</th>
                            <th class="py-3.5 px-4">Judul Buku</th>
                            <th class="py-3.5 px-4">Tanggal Pinjam</th>
                            <th class="py-3.5 px-4">Tanggal Kembali</th>
                            <th class="py-3.5 px-4 rounded-r-xl">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($borrowings as $b)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-4 px-4 font-mono text-xs font-bold text-slate-400">
                                    #{{ $b->id }}
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-900">
                                    {{ $b->user->name ?? 'User Terhapus' }}
                                    <span class="block text-xs font-normal text-slate-400">{{ $b->user->email ?? '-' }}</span>
                                </td>
                                <td class="py-4 px-4 text-slate-800 font-medium">
                                    {{ $b->book->title ?? 'Buku Terhapus' }}
                                    @if($b->book && $b->book->category)
                                        <span class="block text-xs font-normal text-slate-400">{{ $b->book->category->name }}</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-slate-600">
                                    {{ \Carbon\Carbon::parse($b->borrow_date)->translatedFormat('d M Y') }}
                                </td>
                                <td class="py-4 px-4 text-slate-600">
                                    @if($b->return_date)
                                        {{ \Carbon\Carbon::parse($b->return_date)->translatedFormat('d M Y') }}
                                    @else
                                        <span class="text-slate-400 italic">Belum dikembalikan</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    @if($b->status === 'dipinjam')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-600 text-white shadow-xs">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-10 text-center text-slate-400 text-sm">
                                    Tidak ada data transaksi peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($borrowings->hasPages())
                <div class="mt-6 pt-4 border-t border-slate-100">
                    {{ $borrowings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
