@forelse($books as $book)
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs hover:shadow-md transition duration-200 flex flex-col justify-between group">
        <div class="flex space-x-4">
            <!-- Book Cover Placeholder / Icon -->
            <div class="w-20 h-28 bg-gradient-to-br from-slate-100 to-slate-200 border border-slate-300/70 rounded-xl flex-shrink-0 flex items-center justify-center p-2 shadow-inner group-hover:border-purple-300 transition">
                <div class="w-full h-full border border-dashed border-slate-300 rounded-lg flex flex-col items-center justify-center text-slate-400 group-hover:text-purple-600 transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-wider text-slate-400">BUKU</span>
                </div>
            </div>

            <!-- Book Info -->
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-slate-900 text-base leading-snug truncate group-hover:text-purple-900 transition" title="{{ $book->title }}">
                    {{ $book->title }}
                </h3>
                <p class="text-xs font-medium text-slate-500 mt-1 truncate">
                    {{ $book->author }}
                </p>

                <div class="mt-2 flex items-center space-x-2 flex-wrap gap-y-1">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                        {{ $book->category->name ?? 'Umum' }}
                    </span>

                    @if($book->stock > 0)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Stok: {{ $book->stock }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                            Stok: 0 (Habis)
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mt-5 pt-3 border-t border-slate-100">
            @if($book->stock > 0)
                <form method="POST" action="{{ route('peminjam.borrowings.borrow', $book) }}">
                    @csrf
                    <button type="submit"
                            onclick="return confirm('Apakah Anda yakin ingin meminjam buku \'{{ addslashes($book->title) }}\'?')"
                            class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition duration-150 shadow-xs hover:shadow flex items-center justify-center space-x-2 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Pinjam Buku</span>
                    </button>
                </form>
            @else
                <button type="button" disabled
                        class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-slate-400 bg-slate-100 border border-slate-200 cursor-not-allowed flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                    <span>Stok Habis</span>
                </button>
            @endif
        </div>
    </div>
@empty
    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-slate-300">
        <svg class="mx-auto h-12 w-12 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <p class="text-base font-semibold text-slate-700">Tidak ada buku yang ditemukan</p>
        <p class="text-sm text-slate-500 mt-1">Coba kata kunci pencarian lain atau pilih kategori berbeda.</p>
    </div>
@endforelse
