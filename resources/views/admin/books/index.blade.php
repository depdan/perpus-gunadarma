<x-admin-layout>
    <x-slot name="breadcrumb">Kelola Buku</x-slot>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
            <!-- Header with Title and Add Button -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-slate-100 gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                        Kelola Data Buku
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Tambah, ubah, hapus, dan pantau ketersediaan stok buku perpustakaan.
                    </p>
                </div>

                <a href="{{ route('admin.books.create') }}"
                   class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-semibold rounded-xl transition shadow-xs">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Buku
                </a>
            </div>

            <!-- Search and Filter Bar -->
            <form method="GET" action="{{ route('admin.books.index') }}" class="mt-6 flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari judul atau penulis..."
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
                </div>

                <div class="sm:w-56">
                    <select name="category_id"
                            onchange="this.form.submit()"
                            class="w-full py-2.5 px-3.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
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
                            class="px-4 py-2.5 bg-purple-900 text-white font-semibold rounded-xl text-sm hover:bg-purple-800 transition">
                        Filter
                    </button>
                    @if(request('search') || request('category_id'))
                        <a href="{{ route('admin.books.index') }}"
                           class="px-4 py-2.5 bg-slate-100 text-slate-600 font-semibold rounded-xl text-sm hover:bg-slate-200 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <!-- Books Table -->
            <div class="mt-6 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-wider bg-slate-50/60">
                            <th class="py-3.5 px-4 rounded-l-xl w-16">ID</th>
                            <th class="py-3.5 px-4">Judul</th>
                            <th class="py-3.5 px-4">Penulis</th>
                            <th class="py-3.5 px-4">Kategori</th>
                            <th class="py-3.5 px-4 text-center">Stok</th>
                            <th class="py-3.5 px-4 text-center rounded-r-xl w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($books as $book)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-4 px-4 font-mono text-xs font-bold text-slate-400">
                                    #{{ $book->id }}
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-900">
                                    {{ $book->title }}
                                </td>
                                <td class="py-4 px-4 text-slate-600">
                                    {{ $book->author }}
                                </td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ $book->category->name ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($book->stock > 0)
                                        <span class="font-bold text-emerald-600">{{ $book->stock }}</span>
                                    @else
                                        <span class="font-bold text-rose-600">0 (Habis)</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.books.edit', $book) }}"
                                           title="Ubah Buku"
                                           class="p-1.5 text-slate-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <!-- Delete Button -->
                                        <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    title="Hapus Buku"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku \'{{ addslashes($book->title) }}\'?')"
                                                    class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition cursor-pointer">
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
                                <td colspan="6" class="py-10 text-center text-slate-400 text-sm">
                                    Tidak ada data buku yang sesuai dengan pencarian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($books->hasPages())
                <div class="mt-6 pt-4 border-t border-slate-100">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
