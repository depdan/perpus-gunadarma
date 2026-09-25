<x-admin-layout>
    <x-slot name="breadcrumb">Ubah Buku</x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        <div class="bg-white rounded-2xl p-6 sm:p-7 border border-slate-200 shadow-xs">
            <div class="pb-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-900">
                        Ubah Data Buku #{{ $book->id }}
                    </h1>
                    <p class="text-slate-500 text-xs mt-0.5">
                        Perbarui informasi buku perpustakaan.
                    </p>
                </div>

                <a href="{{ route('admin.books.index') }}"
                   class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg transition">
                    &larr; Kembali
                </a>
            </div>

            <form method="POST" action="{{ route('admin.books.update', $book) }}" class="mt-5 space-y-4">
                @csrf
                @method('PUT')

                <!-- Judul Buku -->
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Judul Buku <span class="text-rose-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title', $book->title) }}"
                           required
                           class="w-full px-3.5 py-2.5 bg-slate-50 border @error('title') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition">
                    @error('title')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis & Kategori Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Penulis -->
                    <div>
                        <label for="author" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Penulis <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               name="author"
                               id="author"
                               value="{{ old('author', $book->author) }}"
                               required
                               class="w-full px-3.5 py-2.5 bg-slate-50 border @error('author') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition">
                        @error('author')
                            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                            Kategori <span class="text-rose-500">*</span>
                        </label>
                        <select name="category_id"
                                id="category_id"
                                required
                                class="w-full px-3.5 py-2.5 bg-slate-50 border @error('category_id') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Jumlah Stok <span class="text-rose-500">*</span>
                    </label>
                    <input type="number"
                           name="stock"
                           id="stock"
                           value="{{ old('stock', $book->stock) }}"
                           min="0"
                           required
                           class="w-full sm:w-40 px-3.5 py-2.5 bg-slate-50 border @error('stock') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition">
                    @error('stock')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Deskripsi / Sinopsis (Opsional)
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="3"
                              class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition">{{ old('description', $book->description) }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.books.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition shadow-2xs">
                        Perbarui Data Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
