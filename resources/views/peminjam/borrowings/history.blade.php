<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-slate-100 gap-4">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                            Riwayat Peminjaman Saya
                        </h1>
                        <p class="text-slate-500 text-sm mt-1">
                            Daftar seluruh transaksi peminjaman dan pengembalian buku Anda.
                        </p>
                    </div>

                    <a href="{{ route('peminjam.catalog.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-purple-900 hover:bg-purple-800 text-white text-sm font-semibold rounded-xl transition shadow-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Pinjam Buku Baru
                    </a>
                </div>

                <!-- History Table -->
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider bg-slate-50/50">
                                <th class="py-3.5 px-4 rounded-l-xl">Judul Buku</th>
                                <th class="py-3.5 px-4">Penulis</th>
                                <th class="py-3.5 px-4">Tanggal Pinjam</th>
                                <th class="py-3.5 px-4">Tanggal Kembali</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-4 text-right rounded-r-xl">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($borrowings as $borrowing)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-4 px-4 font-semibold text-slate-900">
                                        {{ $borrowing->book->title ?? 'Buku Tidak Tersedia' }}
                                        @if($borrowing->book && $borrowing->book->category)
                                            <span class="block text-xs font-normal text-slate-400 mt-0.5">
                                                {{ $borrowing->book->category->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-slate-600">
                                        {{ $borrowing->book->author ?? '-' }}
                                    </td>
                                    <td class="py-4 px-4 text-slate-600">
                                        {{ \Carbon\Carbon::parse($borrowing->borrow_date)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="py-4 px-4 text-slate-600">
                                        @if($borrowing->return_date)
                                            {{ \Carbon\Carbon::parse($borrowing->return_date)->translatedFormat('d M Y') }}
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4">
                                        @if($borrowing->status === 'dipinjam')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-500 text-white shadow-xs">
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-right">
                                        @if($borrowing->status === 'dipinjam')
                                            <form method="POST" action="{{ route('peminjam.borrowings.return', $borrowing) }}" class="inline-block">
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Apakah Anda ingin mengembalikan buku \'{{ addslashes($borrowing->book->title ?? '') }}\'?')"
                                                        class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline px-3 py-1.5 rounded-lg border border-blue-200 bg-blue-50/50 hover:bg-blue-100/60 transition cursor-pointer">
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400 italic">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-slate-500">
                                        <svg class="mx-auto h-10 w-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Belum ada riwayat peminjaman buku.
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
    </div>
</x-app-layout>
