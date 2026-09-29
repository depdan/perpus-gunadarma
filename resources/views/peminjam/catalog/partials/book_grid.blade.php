@forelse($books as $book)
    @php
        $coverBgClass = $book->category?->cover_gradient ?? 'from-royal-600 via-royal-700 to-slate-900';
        $catBadgeClass = $book->category?->badge_class ?? 'bg-royal-50 text-royal-700 border-royal-200/80';
        $catDotColor = $book->category?->dot_color ?? 'bg-royal-500';
    @endphp

    <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-card hover:shadow-card-hover hover:border-royal-300 transition duration-200 flex flex-col justify-between group relative overflow-hidden">
        <div>
            <!-- Book Header with Cover and Metadata -->
            <div class="flex space-x-4">
                <!-- Academic Book Spine Preview -->
                <div class="w-20 h-28 sm:w-22 sm:h-30 rounded-xl bg-gradient-to-br {{ $coverBgClass }} text-white p-2.5 flex-shrink-0 flex flex-col justify-between book-spine-effect group-hover:scale-105 transition-transform duration-200 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between">
                        <span class="text-[8px] font-extrabold uppercase tracking-widest text-white/80">UG LIB</span>
                        <div class="w-2 h-2 rounded-full bg-white/40"></div>
                    </div>

                    <div class="text-center py-1">
                        <svg class="w-7 h-7 mx-auto text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>

                    <div class="text-[8px] font-bold text-center text-white/90 truncate">
                        #{{ $book->id }}
                    </div>
                </div>

                <!-- Book Information -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-1 mb-1.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold border {{ $catBadgeClass }}">
                            {{ $book->category->name ?? 'Umum' }}
                        </span>

                        @if($book->year)
                            <span class="text-[10px] font-bold text-slate-400">
                                Th. {{ $book->year }}
                            </span>
                        @endif
                    </div>

                    <h3 class="font-extrabold text-slate-900 text-sm sm:text-base leading-snug line-clamp-2 group-hover:text-royal-700 transition" title="{{ $book->title }}">
                        {{ $book->title }}
                    </h3>

                    <p class="text-xs font-semibold text-slate-600 mt-1 truncate">
                        <span class="text-slate-400 font-normal">Penulis:</span> {{ $book->author }}
                    </p>

                    @if($book->publisher)
                        <p class="text-[11px] text-slate-400 mt-0.5 truncate">
                            {{ $book->publisher }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Description / Stock Info -->
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <div>
                    @if($book->stock > 0)
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                            Tersedia ({{ $book->stock }} unit)
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                            Stok Habis
                        </span>
                    @endif
                </div>

                <span class="text-[11px] font-semibold text-slate-400">
                    Durasi s/d 30 Hari
                </span>
            </div>
        </div>

        <!-- Action Button (Triggers Center Modal Popup for Peminjam, or Panel Link for Admin) -->
        <div class="mt-4 pt-1">
            @if(Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('admin.books.edit', $book) }}"
                   class="w-full py-2.5 px-4 bg-slate-100 hover:bg-royal-50 hover:text-royal-700 text-slate-700 rounded-xl text-xs sm:text-sm font-bold border border-slate-200 transition flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>Kelola di Panel Admin</span>
                </a>
            @elseif($book->stock > 0)
                <button type="button"
                        onclick="triggerBorrowModal('{{ $book->id }}', '{{ addslashes($book->title) }}', '{{ addslashes($book->author) }}', '{{ addslashes($book->category->name ?? 'Umum') }}', '{{ route('peminjam.borrowings.borrow', $book) }}')"
                        class="w-full py-2.5 px-4 btn-primary-royal rounded-xl text-xs sm:text-sm font-bold shadow-royal-sm flex items-center justify-center space-x-2 cursor-pointer">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Ajukan Peminjaman</span>
                </button>
            @else
                <button type="button" disabled
                        class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                    <span>Unit Sedang Dipinjam Semua</span>
                </button>
            @endif
        </div>
    </div>
@empty
    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-dashed border-slate-300 p-8">
        <div class="w-16 h-16 mx-auto rounded-3xl bg-royal-50 text-royal-700 flex items-center justify-center mb-3 ring-8 ring-royal-50/70">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <h4 class="text-base font-extrabold text-slate-800">Tidak ada koleksi buku yang cocok</h4>
        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto leading-relaxed">
            Coba gunakan kata kunci pencarian yang lain, nama penulis, atau pilih kategori literatur berbeda.
        </p>
    </div>
@endforelse
