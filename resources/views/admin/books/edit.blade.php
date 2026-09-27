<x-admin-layout>
    <x-slot name="headerTitle">
        Ubah Data Koleksi Buku
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-6">
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-xs">
            <div class="pb-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                        Ubah Informasi Buku #{{ $book->id }}
                    </h1>
                    <p class="text-slate-500 text-xs mt-1">
                        Perbarui metadata bibliografi dan ketersediaan unit stok buku.
                    </p>
                </div>

                <a href="{{ route('admin.books.index') }}"
                   class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition">
                    &larr; Kembali
                </a>
            </div>

            <form method="POST" action="{{ route('admin.books.update', $book) }}" class="mt-6 space-y-5">
                @csrf
                @method('PUT')

                <!-- Judul Buku -->
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Judul Buku <span class="text-rose-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title', $book->title) }}"
                           required
                           class="w-full px-4 py-2.5 bg-slate-50 border @error('title') border-rose-400 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 transition">
                    @error('title')
                        <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis & Kategori Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Penulis -->
                    <div>
                        <label for="author" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Penulis <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               name="author"
                               id="author"
                               value="{{ old('author', $book->author) }}"
                               required
                               class="w-full px-4 py-2.5 bg-slate-50 border @error('author') border-rose-400 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 transition">
                        @error('author')
                            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Kategori <span class="text-rose-500">*</span>
                        </label>
                        <select name="category_id"
                                id="category_id"
                                required
                                class="w-full px-4 py-2.5 bg-slate-50 border @error('category_id') border-rose-400 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm font-semibold text-slate-700 focus:outline-none focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 transition">
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

                <!-- Penerbit, Tahun, Stok Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Penerbit -->
                    <div>
                        <label for="publisher" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Penerbit
                        </label>
                        <input type="text"
                               name="publisher"
                               id="publisher"
                               value="{{ old('publisher', $book->publisher) }}"
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 transition">
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label for="year" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tahun Terbit
                        </label>
                        <input type="number"
                               name="year"
                               id="year"
                               value="{{ old('year', $book->year ?? date('Y')) }}"
                               min="1900"
                               max="{{ date('Y') + 1 }}"
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 transition">
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stock" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Jumlah Stok <span class="text-rose-500">*</span>
                        </label>
                        <input type="number"
                               name="stock"
                               id="stock"
                               value="{{ old('stock', $book->stock) }}"
                               min="0"
                               required
                               class="w-full px-4 py-2.5 bg-slate-50 border @error('stock') border-rose-400 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm font-bold text-slate-800 focus:outline-none focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 transition">
                        @error('stock')
                            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Deskripsi / Sinopsis (Opsional)
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="3"
                              class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-medium focus:outline-none focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 transition leading-relaxed">{{ old('description', $book->description) }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.books.index') }}"
                       class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="btn-primary-royal px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold shadow-royal-sm">
                        Perbarui Data Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
