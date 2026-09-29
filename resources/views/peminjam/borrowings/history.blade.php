<x-app-layout>
    <div class="py-8 sm:py-10 bg-[#F8FAFC] min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <x-flash-messages />

            <!-- Page Header Card -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-royal-50 text-royal-700 border border-royal-200/80 mb-2">
                        <span class="w-2 h-2 rounded-full bg-royal-600"></span>
                        <span>Sirkulasi Mandiri Anggota</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Riwayat Peminjaman Buku Saya
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Pantau status sirkulasi buku, masa durasi aktif, dan sisa tenggat waktu pengembalian secara transparan.
                    </p>
                </div>

                <a href="{{ route('peminjam.catalog.index') }}"
                   class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold inline-flex items-center justify-center space-x-2 self-start sm:self-auto shadow-royal-sm flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Cari Buku Baru</span>
                </a>
            </div>

            @php
                $activeCount = $borrowings->where('status', 'dipinjam')->count();
                $returnedCount = $borrowings->where('status', 'dikembalikan')->count();
                $overdueCount = $borrowings->filter(function($b) {
                    return $b->status === 'dipinjam' && \Carbon\Carbon::parse($b->due_date)->startOfDay()->isPast();
                })->count();
            @endphp

            <!-- Quick Stat Counters -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Stat 1: Sedang Aktif Dipinjam -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Sedang Dipinjam</div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-royal-700 mt-0.5">{{ $activeCount }}</div>
                        <div class="text-[10px] text-slate-500 font-semibold mt-0.5">Buku di tangan Anda</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-royal-50 text-royal-700 flex items-center justify-center shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>

                <!-- Stat 2: Sudah Dikembalikan -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Telah Dikembalikan</div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600 mt-0.5">{{ $returnedCount }}</div>
                        <div class="text-[10px] text-slate-500 font-semibold mt-0.5">Selesai sirkulasi</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Stat 3: Terlambat / Overdue -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Lewat Tenggat</div>
                        <div class="text-2xl sm:text-3xl font-extrabold {{ $overdueCount > 0 ? 'text-rose-600' : 'text-slate-400' }} mt-0.5">{{ $overdueCount }}</div>
                        <div class="text-[10px] text-slate-500 font-semibold mt-0.5">Harap segera dikembalikan</div>
                    </div>
                    <div class="w-11 h-11 rounded-xl {{ $overdueCount > 0 ? 'bg-rose-50 text-rose-600 ring-4 ring-rose-50' : 'bg-slate-50 text-slate-400' }} flex items-center justify-center shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- History Table Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="font-extrabold text-base sm:text-lg text-slate-900 tracking-tight">
                        Daftar Transaksi Peminjaman
                    </h2>
                    <span class="text-xs font-semibold text-slate-400">
                        Total {{ $borrowings->count() }} transaksi
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200/80 text-left text-sm">
                        <thead class="bg-slate-50/80 text-slate-700 font-bold text-xs uppercase tracking-wider">
                            <tr>
                                <th scope="col" class="px-6 py-4">Informasi Buku</th>
                                <th scope="col" class="px-6 py-4">Tgl Pinjam & Durasi</th>
                                <th scope="col" class="px-6 py-4">Tenggat Pengembalian</th>
                                <th scope="col" class="px-6 py-4">Status & Waktu</th>
                                <th scope="col" class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @forelse($borrowings as $borrowing)
                                @php
                                    $dueDate = \Carbon\Carbon::parse($borrowing->due_date)->startOfDay();
                                    $today = \Carbon\Carbon::now()->startOfDay();
                                    $isOverdue = $borrowing->status === 'dipinjam' && $dueDate->isPast();
                                    $daysRemaining = (int) $today->diffInDays($dueDate, false);
                                    $duration = $borrowing->duration_days;
                                @endphp
                                <tr class="hover:bg-slate-50/60 transition duration-150 group">
                                    <!-- Book Title & Cover -->
                                    <td class="px-6 py-4 whitespace-normal">
                                        <div class="flex items-center space-x-3.5">
                                            <div class="w-10 h-14 bg-gradient-to-br {{ $borrowing->book->category?->cover_gradient ?? 'from-royal-700 to-slate-800' }} text-white rounded-lg flex items-center justify-center flex-shrink-0 book-spine-effect shadow-xs">
                                                <svg class="w-5 h-5 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-extrabold text-slate-900 text-sm group-hover:text-royal-700 transition">
                                                    {{ $borrowing->book->title }}
                                                </div>
                                                <div class="text-xs font-semibold text-slate-500 mt-0.5">
                                                    {{ $borrowing->book->author }}
                                                </div>
                                                <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-bold border {{ $borrowing->book->category?->badge_class ?? 'bg-royal-50 text-royal-700 border-royal-200/80' }} mt-1">
                                                    {{ $borrowing->book->category->name ?? 'Umum' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Borrow Date & Duration -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-xs text-slate-800 font-bold">
                                            {{ \Carbon\Carbon::parse($borrowing->borrow_date)->translatedFormat('d F Y') }}
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200 mt-1">
                                            Durasi: {{ $duration }} Hari
                                        </span>
                                    </td>

                                    <!-- Due Date -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                                        <span class="font-extrabold {{ $isOverdue ? 'text-rose-600' : 'text-slate-800' }}">
                                            {{ \Carbon\Carbon::parse($borrowing->due_date)->translatedFormat('d F Y') }}
                                        </span>
                                        @if($borrowing->status === 'dipinjam')
                                            @if($isOverdue)
                                                <div class="inline-flex items-center text-[10px] font-extrabold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200 mt-1">
                                                    <span>Lewat {{ abs($daysRemaining) }} hari</span>
                                                </div>
                                            @elseif($daysRemaining == 0)
                                                <div class="inline-flex items-center text-[10px] font-extrabold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200 mt-1 animate-pulse">
                                                    <span>Tenggat hari ini!</span>
                                                </div>
                                            @else
                                                <div class="text-[10px] font-bold text-emerald-600 mt-0.5">
                                                    Sisa {{ $daysRemaining }} hari lagi
                                                </div>
                                            @endif
                                        @endif
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($borrowing->status === 'dikembalikan')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-xs">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                                Dikembalikan
                                            </span>
                                            @if($borrowing->return_date)
                                                <div class="text-[10px] text-slate-400 mt-1 font-medium">
                                                    Kembali: {{ \Carbon\Carbon::parse($borrowing->return_date)->translatedFormat('d M Y') }}
                                                </div>
                                            @endif
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

                                    <!-- Action (Opens Return Modal Popup) -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                        @if($borrowing->status === 'dipinjam')
                                            <button type="button"
                                                    onclick="triggerReturnModal('{{ addslashes($borrowing->book->title) }}', '{{ route('peminjam.borrowings.return', $borrowing) }}')"
                                                    class="btn-primary-royal px-4 py-2 rounded-xl text-xs font-bold inline-flex items-center space-x-1.5 cursor-pointer shadow-royal-sm">
                                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Kembalikan</span>
                                            </button>
                                        @else
                                            <span class="inline-flex items-center text-xs text-slate-400 font-semibold px-3 py-1 bg-slate-50 rounded-lg">
                                                <svg class="w-3.5 h-3.5 text-emerald-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Selesai
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="w-16 h-16 mx-auto rounded-3xl bg-royal-50 text-royal-700 flex items-center justify-center mb-3 ring-8 ring-royal-50/70">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <div class="text-base font-extrabold text-slate-800">Belum ada riwayat peminjaman</div>
                                        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto leading-relaxed">
                                            Anda belum meminjam buku apa pun. Silakan kunjungi katalog buku digital kami untuk mulai meminjam referensi akademik.
                                        </p>
                                        <div class="mt-5">
                                            <a href="{{ route('peminjam.catalog.index') }}" class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs font-bold inline-flex items-center space-x-1.5 shadow-royal-sm">
                                                <span>Buka Katalog Buku</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($borrowings, 'hasPages') && $borrowings->hasPages())
                    <div class="px-6 py-4 border-t border-slate-200/80 bg-slate-50/50">
                        {{ $borrowings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Center Return Confirmation Modal Popup -->
    <div id="return-modal"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 hidden opacity-0"
         role="dialog"
         aria-modal="true">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-modal border border-slate-100 transform transition-transform duration-200 scale-95"
             id="return-modal-card">
            
            <div class="text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3.5 ring-8 ring-emerald-50/70 shadow-xs">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900">
                    Konfirmasi Pengembalian Buku
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Pastikan buku fisik telah dikembalikan ke loket perpustakaan.
                </p>
            </div>

            <div class="mt-5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-left">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Judul Buku:</div>
                <div id="return-book-title" class="text-sm font-extrabold text-slate-900 leading-snug mt-0.5">
                    -
                </div>
            </div>

            <form id="return-form" method="POST" action="" class="mt-6">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <button type="button"
                            onclick="closeReturnModal()"
                            class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                            class="w-full py-2.5 px-4 btn-primary-royal rounded-xl text-xs sm:text-sm font-bold shadow-royal-sm cursor-pointer">
                        Ya, Kembalikan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Return Modal Script -->
    <script>
        const returnModal = document.getElementById('return-modal');
        const returnModalCard = document.getElementById('return-modal-card');
        const returnBookTitle = document.getElementById('return-book-title');
        const returnForm = document.getElementById('return-form');

        function triggerReturnModal(title, actionUrl) {
            returnBookTitle.textContent = title;
            returnForm.action = actionUrl;

            returnModal.classList.remove('hidden');
            setTimeout(() => {
                returnModal.classList.remove('opacity-0');
                returnModalCard.classList.remove('scale-95');
                returnModalCard.classList.add('scale-100');
            }, 10);
        }

        function closeReturnModal() {
            returnModal.classList.add('opacity-0');
            returnModalCard.classList.remove('scale-100');
            returnModalCard.classList.add('scale-95');
            setTimeout(() => {
                returnModal.classList.add('hidden');
            }, 200);
        }

        returnModal.addEventListener('click', function(e) {
            if (e.target === returnModal) {
                closeReturnModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !returnModal.classList.contains('hidden')) {
                closeReturnModal();
            }
        });
    </script>
</x-app-layout>
