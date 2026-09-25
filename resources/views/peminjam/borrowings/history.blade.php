<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            <div class="bg-white p-6 sm:p-7 rounded-2xl border border-slate-200 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-5 border-b border-slate-100 gap-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                            Riwayat Peminjaman Saya
                        </h1>
                        <p class="text-slate-500 text-sm mt-0.5">
                            Daftar seluruh transaksi peminjaman dan pengembalian buku Anda.
                        </p>
                    </div>

                    <a href="{{ route('peminjam.catalog.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold rounded-lg transition shadow-2xs">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Pinjam Buku Baru
                    </a>
                </div>

                <!-- History Table -->
                <div class="mt-5 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider bg-slate-50/70">
                                <th class="py-3 px-4 rounded-l-lg">Judul Buku</th>
                                <th class="py-3 px-4">Penulis</th>
                                <th class="py-3 px-4">Tanggal Pinjam</th>
                                <th class="py-3 px-4">Tanggal Kembali</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-right rounded-r-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($borrowings as $borrowing)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="py-3.5 px-4 font-semibold text-slate-900">
                                        {{ $borrowing->book->title ?? 'Buku Tidak Tersedia' }}
                                        @if($borrowing->book && $borrowing->book->category)
                                            <span class="block text-xs font-normal text-slate-400 mt-0.5">
                                                {{ $borrowing->book->category->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-600">
                                        {{ $borrowing->book->author ?? '-' }}
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-600">
                                        {{ \Carbon\Carbon::parse($borrowing->borrow_date)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="py-3.5 px-4 text-slate-600">
                                        @if($borrowing->return_date)
                                            {{ \Carbon\Carbon::parse($borrowing->return_date)->translatedFormat('d M Y') }}
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if($borrowing->status === 'dipinjam')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-600 text-white">
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-right">
                                        @if($borrowing->status === 'dipinjam')
                                            <form method="POST" action="{{ route('peminjam.borrowings.return', $borrowing) }}" class="inline-block">
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Apakah Anda ingin mengembalikan buku \'{{ addslashes($borrowing->book->title ?? '') }}\'?')"
                                                        class="text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline px-3 py-1.5 rounded-lg border border-blue-200 bg-blue-50 hover:bg-blue-100 transition cursor-pointer">
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
                                    <td colspan="6" class="py-10 text-center text-slate-400">
                                        Belum ada riwayat peminjaman buku.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($borrowings->hasPages())
                    <div class="mt-5 pt-3 border-t border-slate-100">
                        {{ $borrowings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
