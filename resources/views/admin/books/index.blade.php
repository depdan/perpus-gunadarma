<x-admin-layout>
    <x-slot name="headerTitle">
        Kelola Koleksi Buku Perpustakaan
    </x-slot>

    <div class="space-y-6">
        <x-flash-messages />

        <!-- Header Card -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                    Database Koleksi Buku
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Tambah, perbarui, dan kelola informasi serta stok fisik buku perpustakaan.
                </p>
            </div>

            <a href="{{ route('admin.books.create') }}"
               class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs sm:text-sm font-bold inline-flex items-center justify-center space-x-2 shadow-royal-sm">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Buku Baru</span>
            </a>
        </div>

        <!-- Filter & Search Bar -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs">
            <form method="GET" action="{{ route('admin.books.index') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari judul buku, penulis, penerbit, atau ISBN..."
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:bg-white transition">
                </div>

                <div class="sm:w-60">
                    <select name="category_id"
                            onchange="this.form.submit()"
                            class="w-full py-2.5 px-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:bg-white transition">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-2">
                    <button type="submit"
                            class="btn-primary-royal px-5 py-2.5 rounded-xl text-xs font-bold">
                        Cari
                    </button>
                    @if(request('search') || request('category_id'))
                        <a href="{{ route('admin.books.index') }}"
                           class="px-4 py-2.5 bg-slate-100 text-slate-700 font-bold rounded-xl text-xs hover:bg-slate-200 transition flex items-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Books Table Card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200/80 text-left text-sm">
                    <thead class="bg-slate-50/80 text-slate-700 font-bold text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 w-16">ID</th>
                            <th class="px-6 py-4">Judul Buku</th>
                            <th class="px-6 py-4">Penulis & Penerbit</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 text-center">Stok Fisik</th>
                            <th class="px-6 py-4 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($books as $book)
                            <tr class="hover:bg-slate-50/60 transition group">
                                <!-- ID -->
                                <td class="px-6 py-4 font-mono text-xs font-bold text-royal-700">
                                    #{{ $book->id }}
                                </td>

                                <!-- Title & Icon -->
                                <td class="px-6 py-4 whitespace-normal">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-10 rounded-lg bg-royal-50 border border-royal-200/70 text-royal-700 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs sm:text-sm font-extrabold text-slate-900 group-hover:text-royal-700 transition">
                                                {{ $book->title }}
                                            </div>
                                            @if($book->year)
                                                <div class="text-[11px] text-slate-400">Tahun Terbit: {{ $book->year }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Penulis -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs font-semibold text-slate-700">{{ $book->author }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $book->publisher ?? '-' }}</div>
                                </td>

                                <!-- Kategori -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-royal-50 text-royal-700 border border-royal-200/80">
                                        {{ $book->category->name ?? 'Umum' }}
                                    </span>
                                </td>

                                <!-- Stok -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($book->stock > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                            {{ $book->stock }} Eksemplar
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                            Habis
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.books.edit', $book) }}"
                                           title="Ubah Buku"
                                           class="p-2 text-slate-500 hover:text-royal-700 hover:bg-royal-50 rounded-xl transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <!-- Delete -->
                                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    title="Hapus Buku"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($book->title) }}\'?')"
                                                    class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400 text-sm">
                                    Tidak ada koleksi buku yang cocok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($books->hasPages())
                <div class="px-6 py-4 border-t border-slate-200/80 bg-slate-50/50">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
