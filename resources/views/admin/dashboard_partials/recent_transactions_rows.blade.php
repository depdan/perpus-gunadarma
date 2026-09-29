@forelse($recentTransactions ?? [] as $trans)
    <tr class="hover:bg-slate-50/60 transition group">
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-royal-50 text-royal-700 font-extrabold text-xs flex items-center justify-center border border-royal-200/70">
                    {{ strtoupper(substr($trans->user->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <div class="font-extrabold text-xs text-slate-900 group-hover:text-royal-700 transition">
                        {{ $trans->user->name ?? 'User' }}
                    </div>
                    <div class="text-[11px] text-slate-400">{{ $trans->user->email ?? '' }}</div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-normal">
            <div class="font-bold text-xs text-slate-800 line-clamp-1">{{ $trans->book->title ?? 'Buku' }}</div>
            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold border {{ $trans->book->category?->badge_class ?? 'bg-royal-50 text-royal-700 border-royal-200/60' }} mt-0.5">
                {{ $trans->book->category->name ?? 'Umum' }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600 font-medium">
            {{ \Carbon\Carbon::parse($trans->borrow_date)->translatedFormat('d M Y') }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            @if($trans->status === 'dikembalikan' || $trans->status === 'returned')
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Dikembalikan
                </span>
            @elseif(\Carbon\Carbon::parse($trans->due_date)->isPast() && $trans->status === 'dipinjam')
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                    Terlambat
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-royal-50 text-royal-700 border border-royal-200">
                    Dipinjam
                </span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="px-6 py-12 text-center text-xs text-slate-400">
            Belum ada transaksi peminjaman terbaru.
        </td>
    </tr>
@endforelse
