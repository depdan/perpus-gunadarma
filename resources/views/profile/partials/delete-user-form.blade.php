<section class="space-y-6">
    <header>
        <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
            Hapus Akun Pengguna
        </h2>

        <p class="mt-1 text-xs text-slate-500 leading-relaxed">
            Setelah akun Anda dihapus, semua data dan informasi akun akan dihapus secara permanen. Pastikan Anda telah menyelesaikan seluruh transaksi sirkulasi buku sebelum menghapus akun.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Hapus Akun Saya</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-7">
            @csrf
            @method('delete')

            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-2 text-xs text-slate-500 leading-relaxed">
                Tindakan ini tidak dapat dibatalkan. Seluruh riwayat dan data akun Anda akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun.
            </p>

            <div class="mt-5">
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Kata Sandi Konfirmasi
                </label>

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-4 py-2.5"
                    placeholder="Masukkan kata sandi Anda"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-danger-button>
                    Ya, Hapus Akun
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
