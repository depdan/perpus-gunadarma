@forelse($lowStockBooks ?? [] as $lowBook)
    <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/60 flex items-center justify-between hover:bg-slate-100/60 transition">
        <div class="min-w-0 pr-2">
            <a href="{{ route('admin.books.edit', $lowBook) }}" class="font-bold text-xs text-slate-800 hover:text-royal-700 truncate block">
                {{ $lowBook->title }}
            </a>
            <div class="text-[10px] text-slate-400 mt-0.5">{{ $lowBook->category->name ?? 'Umum' }}</div>
        </div>
        <a href="{{ route('admin.books.edit', $lowBook) }}"
           class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-extrabold {{ $lowBook->stock == 0 ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-800' }} flex-shrink-0 hover:scale-105 transition-transform"
           title="Klik untuk ubah stok">
            Sisa: {{ $lowBook->stock }} unit
        </a>
    </div>
@empty
    <div class="text-center py-6 text-xs text-slate-400">
        Semua stok koleksi buku dalam kondisi aman.
    </div>
@endforelse
