<x-app-layout>
    <div class="py-8 bg-[#F8FAFC] min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <x-flash-messages />

            <!-- Hero Section in Royal Blue #1E65DE -->
            <div class="bg-royal-700 rounded-2xl p-6 sm:p-8 md:p-10 text-white shadow-royal-md relative overflow-hidden">
                <div class="relative z-10 max-w-3xl">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/20 text-white border border-white/30 backdrop-blur-xs mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>Perpustakaan Universitas Gunadarma</span>
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                        Katalog Buku & Koleksi Digital
                    </h1>
                    <p class="text-royal-100 text-xs sm:text-sm mt-2 max-w-2xl font-normal leading-relaxed">
                        Jelajahi dan pinjam literatur akademik, buku teknologi informatika, sains, bisnis, dan riset ilmiah secara cepat dan praktis.
                    </p>
                </div>

                <!-- Abstract Decorative Shapes -->
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute right-12 top-6 opacity-15 pointer-events-none hidden md:block">
                    <svg class="w-44 h-44 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            <!-- Search Box & Filter Container -->
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                <!-- Search Input with Live AJAX -->
                <div class="relative">
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text"
                               id="live-search-input"
                               value="{{ request('search') }}"
                               placeholder="Cari judul buku, nama penulis, penerbit, atau kategori..."
                               autocomplete="off"
                               class="block w-full pl-11 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:bg-white focus:border-royal-500 transition text-sm font-medium">

                        <div id="search-loading" class="absolute inset-y-0 right-0 pr-4 flex items-center hidden">
                            <svg class="animate-spin h-5 w-5 text-royal-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Category Filter Pills -->
                <div class="flex items-center space-x-2 overflow-x-auto pb-1 text-xs sm:text-sm">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-1 hidden sm:inline">Kategori:</span>
                    <button type="button"
                            data-category=""
                            class="category-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap {{ empty($selectedCategory) ? 'bg-royal-700 text-white shadow-royal-sm' : 'bg-slate-100 text-slate-600 hover:bg-royal-50 hover:text-royal-700' }}">
                        Semua Kategori
                    </button>
                    @foreach($categories as $category)
                        <button type="button"
                                data-category="{{ $category->slug }}"
                                class="category-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap {{ $selectedCategory === $category->slug ? 'bg-royal-700 text-white shadow-royal-sm' : 'bg-slate-100 text-slate-600 hover:bg-royal-50 hover:text-royal-700' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Book Grid Container (AJAX Target) -->
            <div id="book-grid-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-opacity duration-150">
                @include('peminjam.catalog.partials.book_grid', ['books' => $books])
            </div>

        </div>
    </div>

    <!-- Center Confirmation Modal Popup (Custom UI Popup) -->
    <div id="borrow-modal"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 hidden opacity-0"
         role="dialog"
         aria-modal="true">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-100 transform transition-transform duration-200 scale-95"
             id="borrow-modal-card">
            
            <!-- Modal Header Icon & Title -->
            <div class="text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-royal-50 text-royal-700 flex items-center justify-center mb-3 ring-8 ring-royal-50/60">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900">
                    Konfirmasi Peminjaman
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Yakin ingin meminjam buku ini?
                </p>
            </div>

            <!-- Book Summary Box -->
            <div class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-200/80 text-left space-y-1">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">Judul Buku:</div>
                <div id="modal-book-title" class="text-sm font-extrabold text-slate-900 leading-snug">
                    -
                </div>
                <div class="text-xs text-slate-500 font-semibold pt-1">
                    Penulis: <span id="modal-book-author" class="text-slate-700">-</span>
                </div>
            </div>

            <!-- Borrow Form -->
            <form id="modal-borrow-form" method="POST" action="" class="mt-4 space-y-4">
                @csrf
                
                <!-- Duration Select -->
                <div class="text-left">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Pilih Durasi Peminjaman:
                    </label>
                    <select name="duration"
                            class="w-full py-2.5 px-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:border-royal-500 focus:bg-white transition cursor-pointer">
                        <option value="3">3 Hari</option>
                        <option value="7" selected>7 Hari (Standar)</option>
                        <option value="14">14 Hari</option>
                        <option value="30">30 Hari</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-3 pt-2">
                    <button type="button"
                            onclick="closeBorrowModal()"
                            class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                            class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-white bg-royal-700 hover:bg-royal-800 active:bg-royal-900 transition shadow-royal-sm cursor-pointer">
                        Ya, Pinjam Buku
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Live Search & Modal Script -->
    <script>
        // Modal functions
        const borrowModal = document.getElementById('borrow-modal');
        const borrowModalCard = document.getElementById('borrow-modal-card');
        const modalBookTitle = document.getElementById('modal-book-title');
        const modalBookAuthor = document.getElementById('modal-book-author');
        const modalBorrowForm = document.getElementById('modal-borrow-form');

        function triggerBorrowModal(id, title, author, category, actionUrl) {
            modalBookTitle.textContent = title;
            modalBookAuthor.textContent = author;
            modalBorrowForm.action = actionUrl;

            borrowModal.classList.remove('hidden');
            setTimeout(() => {
                borrowModal.classList.remove('opacity-0');
                borrowModalCard.classList.remove('scale-95');
                borrowModalCard.classList.add('scale-100');
            }, 10);
        }

        function closeBorrowModal() {
            borrowModal.classList.add('opacity-0');
            borrowModalCard.classList.remove('scale-100');
            borrowModalCard.classList.add('scale-95');
            setTimeout(() => {
                borrowModal.classList.add('hidden');
            }, 200);
        }

        // Close when clicking outside modal
        borrowModal.addEventListener('click', function(e) {
            if (e.target === borrowModal) {
                closeBorrowModal();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !borrowModal.classList.contains('hidden')) {
                closeBorrowModal();
            }
        });

        // AJAX Live Search
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
                        b.classList.remove('bg-royal-700', 'text-white', 'shadow-royal-sm');
                        b.classList.add('bg-slate-100', 'text-slate-600');
                    });
                    this.classList.add('bg-royal-700', 'text-white', 'shadow-royal-sm');
                    this.classList.remove('bg-slate-100', 'text-slate-600');

                    performSearch();
                });
            });
        });
    </script>
</x-app-layout>
