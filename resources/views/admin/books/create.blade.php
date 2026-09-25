<x-admin-layout>
    <x-slot name="breadcrumb">Tambah Buku Baru</x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs">
            <div class="pb-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                        Tambah Koleksi Buku
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Masukkan data buku perpustakaan secara lengkap dan valid.
                    </p>
                </div>

                <a href="{{ route('admin.books.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">
                    &larr; Kembali
                </a>
            </div>

            <form method="POST" action="{{ route('admin.books.store') }}" class="mt-6 space-y-5">
                @csrf

                <!-- Judul Buku -->
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Judul Buku <span class="text-rose-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title') }}"
                           required
                           placeholder="Contoh: Clean Code: A Handbook of Agile Software Craftsmanship"
                           class="w-full px-4 py-3 bg-slate-50 border @error('title') border-rose-400 bg-rose-50/30 @else border-slate-200 @enderror rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
                    @error('title')
                        <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis & Kategori Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Penulis -->
                    <div>
                        <label for="author" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Penulis <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               name="author"
                               id="author"
                               value="{{ old('author') }}"
                               required
                               placeholder="Contoh: Robert C. Martin"
                               class="w-full px-4 py-3 bg-slate-50 border @error('author') border-rose-400 bg-rose-50/30 @else border-slate-200 @enderror rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
                        @error('author')
                            <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Kategori <span class="text-rose-500">*</span>
                        </label>
                        <select name="category_id"
                                id="category_id"
                                required
                                class="w-full px-4 py-3 bg-slate-50 border @error('category_id') border-rose-400 bg-rose-50/30 @else border-slate-200 @enderror rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Jumlah Stok Eksemplar <span class="text-rose-500">*</span>
                    </label>
                    <input type="number"
                           name="stock"
                           id="stock"
                           value="{{ old('stock', 5) }}"
                           min="0"
                           required
                           class="w-full sm:w-48 px-4 py-3 bg-slate-50 border @error('stock') border-rose-400 bg-rose-50/30 @else border-slate-200 @enderror rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">
                    @error('stock')
                        <p class="text-rose-600 text-xs mt-1.5 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Deskripsi / Sinopsis (Opsional)
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              placeholder="Tuliskan ringkasan materi atau sinopsis buku..."
                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition">{{ old('description') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.books.index') }}"
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 transition shadow-xs">
                        Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
