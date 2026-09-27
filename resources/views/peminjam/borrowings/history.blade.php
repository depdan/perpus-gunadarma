<x-app-layout>
    <div class="py-8 bg-[#F8FAFC] min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            <!-- Header Title -->
            <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-royal-50 text-royal-700 border border-royal-200/80 mb-2">
                        <span>Sirkulasi Mandiri</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Riwayat Peminjaman Saya
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Pantau status sirkulasi, durasi masa pinjam, dan sisa waktu pengembalian buku Anda.
                    </p>
                </div>
                <a href="{{ route('peminjam.catalog.index') }}"
                   class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold inline-flex items-center justify-center space-x-2 self-start sm:self-auto shadow-royal-sm">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Cari Buku Baru</span>
                </a>
            </div>

            <!-- History Table Card -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
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
                                <tr class="hover:bg-slate-50/60 transition duration-150">
                                    <!-- Book Title & Cover -->
                                    <td class="px-6 py-4 whitespace-normal">
                                        <div class="flex items-center space-x-3.5">
                                            <div class="w-11 h-14 bg-royal-50 border border-royal-200/70 rounded-lg flex items-center justify-center flex-shrink-0 text-royal-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-extrabold text-slate-900 text-sm">
                                                    {{ $borrowing->book->title }}
                                                </div>
                                                <div class="text-xs font-semibold text-slate-500">
                                                    {{ $borrowing->book->author }}
                                                </div>
                                                <div class="text-[11px] text-royal-700 font-bold mt-0.5">
                                                    {{ $borrowing->book->category->name ?? 'Umum' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Borrow Date & Duration -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-xs text-slate-700 font-bold">
                                            {{ \Carbon\Carbon::parse($borrowing->borrow_date)->translatedFormat('d M Y') }}
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-royal-50 text-royal-700 border border-royal-200/80 mt-1">
                                            Durasi: {{ $duration }} Hari
                                        </span>
                                    </td>

                                    <!-- Due Date -->
                                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                                        <span class="font-bold {{ $isOverdue ? 'text-rose-600' : 'text-slate-800' }}">
                                            {{ \Carbon\Carbon::parse($borrowing->due_date)->translatedFormat('d M Y') }}
                                        </span>
                                        @if($borrowing->status === 'dipinjam')
                                            @if($isOverdue)
                                                <div class="text-[10px] font-bold text-rose-600 mt-0.5">
                                                    Lewat {{ abs($daysRemaining) }} hari
                                                </div>
                                            @elseif($daysRemaining == 0)
                                                <div class="text-[10px] font-bold text-amber-600 mt-0.5">
                                                    Tenggat hari ini!
                                                </div>
                                            @else
                                                <div class="text-[10px] font-semibold text-emerald-600 mt-0.5">
                                                    Sisa {{ $daysRemaining }} hari lagi
                                                </div>
                                            @endif
                                        @endif
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($borrowing->status === 'dikembalikan')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                                Dikembalikan
                                            </span>
                                            @if($borrowing->return_date)
                                                <div class="text-[10px] text-slate-400 mt-1">
                                                    Kembali: {{ \Carbon\Carbon::parse($borrowing->return_date)->translatedFormat('d M Y') }}
                                                </div>
                                            @endif
                                        @elseif($isOverdue)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                                Terlambat
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-royal-50 text-royal-700 border border-royal-200">
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
                                            <span class="text-xs text-slate-400 font-semibold">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="w-12 h-12 mx-auto rounded-2xl bg-royal-50 text-royal-700 flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <div class="text-sm font-bold text-slate-700">Belum ada riwayat peminjaman</div>
                                        <p class="text-xs text-slate-500 mt-1">Anda belum meminjam buku apa pun. Silakan kunjungi katalog buku.</p>
                                        <div class="mt-4">
                                            <a href="{{ route('peminjam.catalog.index') }}" class="btn-primary-royal px-4 py-2 rounded-xl text-xs font-bold inline-flex items-center space-x-1.5">
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
        <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 transform transition-transform duration-200 scale-95"
             id="return-modal-card">
            
            <div class="text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 ring-8 ring-emerald-50/60">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900">
                    Konfirmasi Pengembalian
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Apakah Anda yakin ingin mengembalikan buku ini?
                </p>
            </div>

            <div class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-left">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Judul Buku:</div>
                <div id="return-book-title" class="text-sm font-extrabold text-slate-900 leading-snug mt-0.5">
                    -
                </div>
            </div>

            <form id="return-form" method="POST" action="" class="mt-5">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <button type="button"
                            onclick="closeReturnModal()"
                            class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                            class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-white bg-royal-700 hover:bg-royal-800 active:bg-royal-900 transition shadow-royal-sm cursor-pointer">
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
