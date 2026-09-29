<x-app-layout>
    <div class="py-8 sm:py-10 bg-[#F8FAFC] min-h-[calc(100vh-4rem)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <x-flash-messages />

            <!-- Academic Hero Banner -->
            <div class="relative bg-gradient-to-br from-royal-700 via-royal-800 to-slate-900 rounded-3xl p-6 sm:p-10 md:p-12 text-white shadow-royal-md overflow-hidden border border-royal-600/30">
                <div class="relative z-10 max-w-3xl space-y-4">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/15 text-white border border-white/20 backdrop-blur-md shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Layanan Sirkulasi Mandiri Mahasiswa & Dosen</span>
                    </div>
                    
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight">
                        Katalog Koleksi Literatur & Buku Digital
                    </h1>
                    
                    <p class="text-royal-100 text-xs sm:text-sm md:text-base max-w-2xl font-normal leading-relaxed">
                        Cari dan pinjam referensi akademik, literatur teknologi informatika, sains terapan, manajemen bisnis, dan riset ilmiah Universitas Gunadarma secara instan.
                    </p>

                    <!-- Quick Highlights Counter -->
                    <div class="pt-2 flex flex-wrap gap-4 text-xs font-semibold text-royal-100/90">
                        <div class="flex items-center space-x-2 bg-white/10 px-3.5 py-2 rounded-xl backdrop-blur-xs border border-white/10">
                            <svg class="w-4 h-4 text-royal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>Peminjaman Mandiri 24/7</span>
                        </div>
                        <div class="flex items-center space-x-2 bg-white/10 px-3.5 py-2 rounded-xl backdrop-blur-xs border border-white/10">
                            <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Stok Fisik Real-Time</span>
                        </div>
                        <div class="flex items-center space-x-2 bg-white/10 px-3.5 py-2 rounded-xl backdrop-blur-xs border border-white/10">
                            <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Durasi Pilihan Fleksibel</span>
                        </div>
                    </div>
                </div>

                <!-- Abstract Decorative Geometry -->
                <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute right-10 top-8 opacity-15 pointer-events-none hidden lg:block">
                    <svg class="w-56 h-56 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>

            @if(Auth::check() && Auth::user()->isAdmin())
                <!-- Admin Preview Notice Banner -->
                <div class="p-4 sm:p-5 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 shadow-xs">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center font-bold flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text-xs sm:text-sm">
                            <span class="font-extrabold text-amber-950">Mode Pratinjau Administrator:</span>
                            <span class="text-amber-800">Akun Admin bertugas mengelola buku dan memantau sirkulasi. Fitur peminjaman dikhususkan untuk akun Mahasiswa/Peminjam.</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-amber-200/90 hover:bg-amber-300 text-amber-900 font-bold rounded-xl text-xs transition whitespace-nowrap self-start sm:self-center shadow-xs">
                        Kembali ke Panel Admin &rarr;
                    </a>
                </div>
            @endif

            <!-- Search Box & Filter Container -->
            <div class="bg-white p-5 sm:p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
                <!-- Search Input with Live AJAX and Clear Button -->
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
                               placeholder="Cari judul buku, nama penulis, penerbit, topik ilmiah, atau kategori..."
                               autocomplete="off"
                               class="block w-full pl-11 pr-20 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:bg-white focus:border-royal-500 transition text-xs sm:text-sm font-medium">

                        <!-- Clear search button -->
                        <button type="button"
                                id="clear-search-btn"
                                onclick="clearSearchInput()"
                                class="absolute right-10 p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hidden transition"
                                title="Hapus pencarian">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        <!-- Spinner Loading -->
                        <div id="search-loading" class="absolute inset-y-0 right-0 pr-4 flex items-center hidden">
                            <svg class="animate-spin h-5 w-5 text-royal-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Category Filter Chips -->
                <div class="flex items-center space-x-2 overflow-x-auto pb-1.5 text-xs sm:text-sm no-scrollbar">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-1 hidden sm:inline flex-shrink-0">
                        Kategori:
                    </span>

                    <button type="button"
                            data-category=""
                            class="category-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap flex items-center space-x-2 {{ empty($selectedCategory) ? 'bg-royal-700 text-white shadow-royal-sm ring-2 ring-royal-700/20' : 'bg-slate-100 text-slate-600 hover:bg-royal-50 hover:text-royal-700' }}">
                        <span class="w-2 h-2 rounded-full bg-royal-400"></span>
                        <span>Semua Koleksi</span>
                    </button>

                    @foreach($categories as $category)
                        <button type="button"
                                data-category="{{ $category->slug }}"
                                class="category-filter-btn px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap flex items-center space-x-2 {{ $selectedCategory === $category->slug ? 'bg-royal-700 text-white shadow-royal-sm ring-2 ring-royal-700/20' : 'bg-slate-100 text-slate-600 hover:bg-royal-50 hover:text-royal-700' }}">
                            <span class="w-2 h-2 rounded-full {{ $category->dot_color }}"></span>
                            <span>{{ $category->name }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Book Grid Section -->
            <div>
                <div class="flex items-center justify-between mb-4 px-1">
                    <h2 class="font-extrabold text-base sm:text-lg text-slate-900 tracking-tight flex items-center space-x-2">
                        <span>Daftar Literatur Tersedia</span>
                    </h2>
                    <span id="catalog-count-indicator" class="text-xs font-semibold text-slate-500">
                        Menampilkan koleksi buku
                    </span>
                </div>

                <!-- Book Grid Container (AJAX Target) -->
                <div id="book-grid-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-opacity duration-150">
                    @include('peminjam.catalog.partials.book_grid', ['books' => $books])
                </div>
            </div>

        </div>
    </div>

    <!-- Center Confirmation Modal Popup (Custom UI Popup) -->
    <div id="borrow-modal"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-200 hidden opacity-0"
         role="dialog"
         aria-modal="true">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-modal border border-slate-100 transform transition-transform duration-200 scale-95"
             id="borrow-modal-card">
            
            <!-- Modal Header Icon & Title -->
            <div class="text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-royal-50 text-royal-700 flex items-center justify-center mb-3.5 ring-8 ring-royal-50/70 shadow-xs">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-extrabold text-slate-900">
                    Konfirmasi Peminjaman Buku
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Silakan tinjau detail buku dan tentukan durasi peminjaman.
                </p>
            </div>

            <!-- Book Summary Box -->
            <div class="mt-5 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-left space-y-2">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Judul Buku</div>
                    <div id="modal-book-title" class="text-sm font-extrabold text-slate-900 leading-snug mt-0.5">
                        -
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1 border-t border-slate-200/60">
                    <span class="text-slate-500 font-semibold">Penulis: <strong id="modal-book-author" class="text-slate-800">-</strong></span>
                    <span id="modal-book-category" class="px-2 py-0.5 rounded-lg text-[10px] font-bold bg-royal-100 text-royal-700">Kategori</span>
                </div>
            </div>

            <!-- Borrow Form -->
            <form id="modal-borrow-form" method="POST" action="" class="mt-5 space-y-4">
                @csrf
                
                <!-- Duration Select with Live Due Date Calculation -->
                <div class="text-left">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Durasi Masa Peminjaman
                    </label>
                    <select id="borrow-duration-select"
                            name="duration"
                            onchange="updateEstimatedDueDate()"
                            class="w-full py-2.5 px-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-royal-500 focus:border-royal-500 focus:bg-white transition cursor-pointer">
                        <option value="3">3 Hari (Urgensi Cepat)</option>
                        <option value="7" selected>7 Hari (Standar Akademik)</option>
                        <option value="14">14 Hari (2 Minggu)</option>
                        <option value="30">30 Hari (Riset & Tugas Akhir)</option>
                    </select>

                    <!-- Calculated Due Date Banner -->
                    <div class="mt-2.5 p-2.5 rounded-xl bg-royal-50/80 border border-royal-200/80 flex items-center space-x-2 text-xs text-royal-800">
                        <svg class="w-4 h-4 text-royal-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Estimasi Tenggat Kembali: <strong id="modal-estimated-due-date" class="font-extrabold text-royal-900">-</strong></span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-3 pt-3 border-t border-slate-100">
                    <button type="button"
                            onclick="closeBorrowModal()"
                            class="w-full py-2.5 px-4 rounded-xl text-xs sm:text-sm font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit"
                            class="w-full py-2.5 px-4 btn-primary-royal rounded-xl text-xs sm:text-sm font-bold shadow-royal-sm cursor-pointer">
                        Ya, Pinjam Buku
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Live Search & Modal Script -->
    <script>
        const borrowModal = document.getElementById('borrow-modal');
        const borrowModalCard = document.getElementById('borrow-modal-card');
        const modalBookTitle = document.getElementById('modal-book-title');
        const modalBookAuthor = document.getElementById('modal-book-author');
        const modalBookCategory = document.getElementById('modal-book-category');
        const modalBorrowForm = document.getElementById('modal-borrow-form');
        const durationSelect = document.getElementById('borrow-duration-select');
        const estimatedDueDateEl = document.getElementById('modal-estimated-due-date');
        const searchInput = document.getElementById('live-search-input');
        const clearSearchBtn = document.getElementById('clear-search-btn');

        function updateEstimatedDueDate() {
            const days = parseInt(durationSelect.value) || 7;
            const targetDate = new Date();
            targetDate.setDate(targetDate.getDate() + days);

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            estimatedDueDateEl.textContent = targetDate.toLocaleDateString('id-ID', options);
        }

        function triggerBorrowModal(id, title, author, category, actionUrl) {
            modalBookTitle.textContent = title;
            modalBookAuthor.textContent = author;
            modalBookCategory.textContent = category;
            modalBorrowForm.action = actionUrl;
            
            updateEstimatedDueDate();

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

        function clearSearchInput() {
            searchInput.value = '';
            clearSearchBtn.classList.add('hidden');
            searchInput.dispatchEvent(new Event('input'));
            searchInput.focus();
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
            const searchLoading = document.getElementById('search-loading');
            const gridContainer = document.getElementById('book-grid-container');
            const categoryBtns = document.querySelectorAll('.category-filter-btn');

            let activeCategory = '{{ $selectedCategory ?? '' }}';
            let debounceTimer = null;

            if (searchInput.value.trim().length > 0) {
                clearSearchBtn.classList.remove('hidden');
            }

            function performSearch() {
                const query = searchInput.value.trim();
                
                if (query.length > 0) {
                    clearSearchBtn.classList.remove('hidden');
                } else {
                    clearSearchBtn.classList.add('hidden');
                }

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
                debounceTimer = setTimeout(performSearch, 250);
            });

            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    activeCategory = this.getAttribute('data-category');

                    categoryBtns.forEach(b => {
                        b.classList.remove('bg-royal-700', 'text-white', 'shadow-royal-sm', 'ring-2', 'ring-royal-700/20');
                        b.classList.add('bg-slate-100', 'text-slate-600');
                    });
                    this.classList.add('bg-royal-700', 'text-white', 'shadow-royal-sm', 'ring-2', 'ring-royal-700/20');
                    this.classList.remove('bg-slate-100', 'text-slate-600');

                    performSearch();
                });
            });
        });
    </script>
</x-app-layout>
