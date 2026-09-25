<x-app-layout>
    <div class="py-8 bg-slate-50 min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            <!-- Hero & Search Section -->
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-xs">
                <div class="max-w-3xl">
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Katalog Buku Perpustakaan
                    </h1>
                    <p class="text-slate-600 text-sm mt-1">
                        Temukan dan pinjam koleksi buku literatur, teknologi, sains, dan referensi akademik.
                    </p>
                </div>

                <!-- Live Search Bar -->
                <div class="mt-6 relative">
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text"
                               id="live-search-input"
                               value="{{ request('search') }}"
                               placeholder="Cari judul, penulis, atau kategori..."
                               autocomplete="off"
                               class="block w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition text-sm sm:text-base font-medium">

                        <div id="search-loading" class="absolute inset-y-0 right-0 pr-4 flex items-center hidden">
                            <svg class="animate-spin h-5 w-5 text-purple-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Category Filters -->
                <div class="mt-4 flex items-center space-x-2 overflow-x-auto pb-1 text-xs sm:text-sm">
                    <button type="button"
                            data-category=""
                            class="category-filter-btn px-4 py-1.5 rounded-full font-semibold transition cursor-pointer {{ empty($selectedCategory) ? 'bg-purple-900 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Semua Kategori
                    </button>
                    @foreach($categories as $category)
                        <button type="button"
                                data-category="{{ $category->slug }}"
                                class="category-filter-btn px-4 py-1.5 rounded-full font-semibold transition cursor-pointer {{ $selectedCategory === $category->slug ? 'bg-purple-900 text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Book Grid Container (Target for AJAX Live Search) -->
            <div id="book-grid-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-opacity duration-200">
                @include('peminjam.catalog.partials.book_grid', ['books' => $books])
            </div>

        </div>
    </div>

    <!-- Live Search AJAX Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('live-search-input');
            const searchLoading = document.getElementById('search-loading');
            const gridContainer = document.getElementById('book-grid-container');
            const categoryBtns = document.querySelectorAll('.category-filter-btn');

            let activeCategory = '{{ $selectedCategory ?? '' }}';
            let debounceTimer = null;

            function performSearch() {
                const query = searchInput.value.trim();
                searchLoading.classList.remove('hidden');
                gridContainer.classList.add('opacity-50');

                const searchUrl = new URL('{{ route("peminjam.catalog.search") }}', window.location.origin);
                if (query) searchUrl.searchParams.set('q', query);
                if (activeCategory) searchUrl.searchParams.set('category', activeCategory);

                fetch(searchUrl.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    gridContainer.innerHTML = data.html;
                })
                .catch(err => {
                    console.error('Error saat live search:', err);
                })
                .finally(() => {
                    searchLoading.classList.add('hidden');
                    gridContainer.classList.remove('opacity-50');
                });
            }

            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(performSearch, 300);
            });

            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    activeCategory = this.getAttribute('data-category');

                    categoryBtns.forEach(b => {
                        b.classList.remove('bg-purple-900', 'text-white', 'shadow-xs');
                        b.classList.add('bg-slate-100', 'text-slate-700');
                    });
                    this.classList.add('bg-purple-900', 'text-white', 'shadow-xs');
                    this.classList.remove('bg-slate-100', 'text-slate-700');

                    performSearch();
                });
            });
        });
    </script>
</x-app-layout>
