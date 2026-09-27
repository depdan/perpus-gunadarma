@forelse($books as $book)
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-royal-md hover:border-royal-300 transition duration-200 flex flex-col justify-between group">
        <div class="flex space-x-4">
            <!-- Book Cover Thumbnail -->
            <div class="w-20 h-28 bg-royal-50 border border-royal-200/70 rounded-xl flex-shrink-0 flex items-center justify-center p-2 group-hover:border-royal-400 group-hover:bg-royal-100/50 transition">
                <div class="w-full h-full border border-dashed border-royal-300/80 rounded-lg flex flex-col items-center justify-center text-royal-700 group-hover:scale-105 transition-transform">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-[9px] font-extrabold uppercase tracking-wider">BUKU</span>
                </div>
            </div>

            <!-- Book Information -->
            <div class="flex-1 min-w-0 flex flex-col justify-between">
                <div>
                    <h3 class="font-extrabold text-slate-900 text-sm sm:text-base leading-snug line-clamp-2 group-hover:text-royal-700 transition" title="{{ $book->title }}">
                        {{ $book->title }}
                    </h3>
                    <p class="text-xs font-semibold text-slate-500 mt-1 truncate">
                        {{ $book->author }}
                    </p>
                    @if($book->publisher)
                        <p class="text-[11px] text-slate-400 truncate">
                            {{ $book->publisher }} @if($book->year)({{ $book->year }})@endif
                        </p>
                    @endif
                </div>

                <div class="mt-3 flex items-center space-x-2 flex-wrap gap-y-1.5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[11px] font-bold bg-royal-50 text-royal-700 border border-royal-200/80">
                        {{ $book->category->name ?? 'Umum' }}
                    </span>

                    @if($book->stock > 0)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                            Stok: {{ $book->stock }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                            Habis
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Button (Triggers Center Modal Popup) -->
        <div class="mt-4 pt-3 border-t border-slate-100">
            @if($book->stock > 0)
                <button type="button"
                        onclick="triggerBorrowModal('{{ $book->id }}', '{{ addslashes($book->title) }}', '{{ addslashes($book->author) }}', '{{ addslashes($book->category->name ?? 'Umum') }}', '{{ route('peminjam.borrowings.borrow', $book) }}')"
                        class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-white bg-royal-700 hover:bg-royal-800 active:bg-royal-900 transition-all shadow-royal-sm flex items-center justify-center space-x-2 cursor-pointer">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Pinjam Buku</span>
                </button>
            @else
                <button type="button" disabled
                        class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                    <span>Stok Habis</span>
                </button>
            @endif
        </div>
    </div>
@empty
    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-slate-300 p-8">
        <div class="w-14 h-14 mx-auto rounded-2xl bg-royal-50 text-royal-700 flex items-center justify-center mb-3">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <h4 class="text-base font-bold text-slate-800">Tidak ada buku yang cocok</h4>
        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">Coba gunakan kata kunci pencarian yang lain atau pilih kategori literatur berbeda.</p>
    </div>
@endforelse
