<x-admin-layout>
    <x-slot name="headerTitle">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <span>Dashboard Utama Koleksi & Peminjaman</span>
            <!-- Live Sync Real-time Status Badge -->
            <div class="flex items-center space-x-2 text-xs font-semibold">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/80 shadow-2xs">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span>Live Sync Real-Time</span>
                </div>
                <button type="button"
                        id="btn-manual-sync"
                        onclick="syncDashboardRealtime(true)"
                        title="Klik untuk sinkronisasi data seketika"
                        class="px-2.5 py-1 rounded-full bg-slate-100 hover:bg-royal-50 hover:text-royal-700 text-slate-600 transition flex items-center space-x-1 cursor-pointer">
                    <svg id="sync-spinner-icon" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span class="text-[11px] font-bold">Sinkron: <span id="last-sync-time">{{ now()->translatedFormat('H:i:s') }}</span></span>
                </button>
            </div>
        </div>
    </x-slot>

    <x-flash-messages />

    <!-- Metric Statistic Cards (4-Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Metric 1: Total Koleksi Buku -->
        <div id="card-total-books" class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-card hover:shadow-card-hover transition duration-300 flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Koleksi Buku</div>
                <div id="stat-total-books" class="text-3xl font-extrabold text-slate-900 mt-1 transition-all duration-300">
                    {{ $totalBooks ?? 0 }}
                </div>
                <div class="text-[11px] font-bold text-royal-700 mt-1 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-royal-600 shrink-0"></span>
                    <span>Total Stok: <span id="stat-total-stock">{{ $totalStock ?? 0 }}</span> Buku</span>
                </div>
            </div>
            <div class="w-13 h-13 rounded-2xl bg-royal-50 text-royal-700 flex items-center justify-center ring-8 ring-royal-50/70 shadow-xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>

        <!-- Metric 2: Total Anggota / Peminjam -->
        <div id="card-total-members" class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-card hover:shadow-card-hover transition duration-300 flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Anggota</div>
                <div id="stat-total-members" class="text-3xl font-extrabold text-slate-900 mt-1 transition-all duration-300">
                    {{ $totalBorrowers ?? $totalMembers ?? 0 }}
                </div>
                <div class="text-[11px] font-bold text-emerald-600 mt-1 flex items-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                    Mahasiswa & Dosen
                </div>
            </div>
            <div class="w-13 h-13 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center ring-8 ring-emerald-50/70 shadow-xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>

        <!-- Metric 3: Sedang Dipinjam -->
        <div id="card-active-borrowings" class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-card hover:shadow-card-hover transition duration-300 flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Sedang Dipinjam</div>
                <div id="stat-active-borrowings" class="text-3xl font-extrabold text-royal-700 mt-1 transition-all duration-300">
                    {{ $activeBorrowings ?? 0 }}
                </div>
                <div class="text-[11px] font-bold text-royal-700 mt-1 flex items-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-royal-700 mr-1.5 animate-pulse"></span>
                    Buku Beredar
                </div>
            </div>
            <div class="w-13 h-13 rounded-2xl bg-royal-100/70 text-royal-700 flex items-center justify-center ring-8 ring-royal-100/50 shadow-xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
            </div>
        </div>

        <!-- Metric 4: Terlambat / Overdue -->
        <div id="card-overdue-borrowings" class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-card hover:shadow-card-hover transition duration-300 flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Lewat Tenggat</div>
                <div id="stat-overdue-borrowings" class="text-3xl font-extrabold {{ ($overdueBorrowings ?? 0) > 0 ? 'text-rose-600' : 'text-slate-900' }} mt-1 transition-all duration-300">
                    {{ $overdueBorrowings ?? 0 }}
                </div>
                <div id="stat-overdue-label" class="text-[11px] font-bold {{ ($overdueBorrowings ?? 0) > 0 ? 'text-rose-600' : 'text-slate-400' }} mt-1 flex items-center">
                    <span class="w-1.5 h-1.5 rounded-full {{ ($overdueBorrowings ?? 0) > 0 ? 'bg-rose-500' : 'bg-slate-300' }} mr-1.5"></span>
                    Perlu Tindak Lanjut
                </div>
            </div>
            <div id="stat-overdue-icon-box" class="w-13 h-13 rounded-2xl {{ ($overdueBorrowings ?? 0) > 0 ? 'bg-rose-50 text-rose-600 ring-8 ring-rose-50/70' : 'bg-slate-50 text-slate-400' }} flex items-center justify-center shadow-xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Content Section: Recent Transactions & Low Stock Alerts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Transactions (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-extrabold text-base text-slate-900">Transaksi Peminjaman Terkini</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Aktivitas peminjaman dan pengembalian buku anggota secara real-time</p>
                </div>
                <a href="{{ route('admin.borrowings.index') }}" class="text-xs font-bold text-royal-700 hover:text-royal-800 transition flex items-center space-x-1">
                    <span>Lihat Semua</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="min-w-full divide-y divide-slate-100 text-left text-sm">
                    <thead class="bg-slate-50/70 text-slate-600 font-bold text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">Peminjam</th>
                            <th class="px-6 py-4">Buku</th>
                            <th class="px-6 py-4">Tgl Pinjam</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody id="recent-transactions-tbody" class="divide-y divide-slate-100">
                        @include('admin.dashboard_partials.recent_transactions_rows', ['recentTransactions' => $recentTransactions ?? $recentBorrowings ?? []])
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Low Stock Alerts (1 Col) -->
        <div class="space-y-6">
            <!-- Quick Actions Card -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                <h3 class="font-extrabold text-base text-slate-900 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.books.create') }}"
                       class="w-full btn-primary-royal py-3 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center space-x-2 shadow-royal-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Tambah Buku Baru</span>
                    </a>

                    <a href="{{ route('admin.borrowings.index') }}"
                       class="w-full btn-soft-royal py-3 px-4 rounded-xl text-xs sm:text-sm font-bold flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-royal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Lihat Semua Peminjaman</span>
                    </a>
                </div>
            </div>

            <!-- Low Stock Warnings -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-extrabold text-sm text-slate-900">Peringatan Stok Buku</h3>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-50 text-rose-600 border border-rose-200">Perhatian</span>
                </div>

                <div id="low-stock-container" class="space-y-3">
                    @include('admin.dashboard_partials.low_stock_items', ['lowStockBooks' => $lowStockBooks ?? []])
                </div>
            </div>
        </div>
    </div>

    <!-- Client-side Real-time Polling & Live Animation Script -->
    <script>
        let isSyncing = false;
        const STATS_URL = '{{ route('admin.dashboard.stats') }}';

        function flashCardUpdate(elementId) {
            const el = document.getElementById(elementId);
            if (el) {
                el.classList.add('ring-4', 'ring-emerald-400/40', 'scale-[1.02]');
                setTimeout(() => {
                    el.classList.remove('ring-4', 'ring-emerald-400/40', 'scale-[1.02]');
                }, 1000);
            }
        }

        async function syncDashboardRealtime(isManual = false) {
            if (isSyncing) return;
            isSyncing = true;

            const spinner = document.getElementById('sync-spinner-icon');
            if (spinner) spinner.classList.add('animate-spin');

            try {
                const response = await fetch(STATS_URL, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) return;

                const res = await response.json();
                if (res.status === 'success') {
                    // Update Total Books
                    const elBooks = document.getElementById('stat-total-books');
                    if (elBooks && elBooks.innerText.trim() !== String(res.total_books)) {
                        elBooks.innerText = res.total_books;
                        flashCardUpdate('card-total-books');
                    }

                    const elStock = document.getElementById('stat-total-stock');
                    if (elStock) elStock.innerText = res.total_stock;

                    // Update Total Members
                    const elMembers = document.getElementById('stat-total-members');
                    if (elMembers && elMembers.innerText.trim() !== String(res.total_members)) {
                        elMembers.innerText = res.total_members;
                        flashCardUpdate('card-total-members');
                    }

                    // Update Active Borrowings
                    const elActive = document.getElementById('stat-active-borrowings');
                    if (elActive && elActive.innerText.trim() !== String(res.active_borrowings)) {
                        elActive.innerText = res.active_borrowings;
                        flashCardUpdate('card-active-borrowings');
                    }

                    // Update Overdue Borrowings
                    const elOverdue = document.getElementById('stat-overdue-borrowings');
                    if (elOverdue && elOverdue.innerText.trim() !== String(res.overdue_borrowings)) {
                        elOverdue.innerText = res.overdue_borrowings;
                        flashCardUpdate('card-overdue-borrowings');
                    }

                    // Update Transactions Table HTML
                    const tbody = document.getElementById('recent-transactions-tbody');
                    if (tbody && res.recent_transactions_html) {
                        tbody.innerHTML = res.recent_transactions_html;
                    }

                    // Update Low Stock HTML
                    const lowStockBox = document.getElementById('low-stock-container');
                    if (lowStockBox && res.low_stock_html) {
                        lowStockBox.innerHTML = res.low_stock_html;
                    }

                    // Update Last Sync Timestamp
                    const elSyncTime = document.getElementById('last-sync-time');
                    if (elSyncTime && res.updated_at) {
                        elSyncTime.innerText = res.updated_at;
                    }
                }
            } catch (err) {
                console.error('Error syncing realtime dashboard:', err);
            } finally {
                isSyncing = false;
                if (spinner) {
                    setTimeout(() => spinner.classList.remove('animate-spin'), 400);
                }
            }
        }

        // Auto poll every 3 seconds
        let syncInterval = setInterval(() => syncDashboardRealtime(false), 3000);

        // Resume / pause polling on window tab visibility change
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                clearInterval(syncInterval);
            } else {
                syncDashboardRealtime(false);
                syncInterval = setInterval(() => syncDashboardRealtime(false), 3000);
            }
        });
    </script>
</x-admin-layout>
