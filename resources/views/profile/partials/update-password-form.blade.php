<section>
    <header>
        <h2 class="text-base sm:text-lg font-extrabold text-slate-900">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-1 text-xs text-slate-500 leading-relaxed">
            Pastikan akun Anda menggunakan kata sandi yang aman dan tidak mudah ditebak.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Kata Sandi Saat Ini <span class="text-rose-500">*</span>
            </label>
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-2.5" autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Kata Sandi Baru <span class="text-rose-500">*</span>
            </label>
            <x-text-input id="update_password_password" name="password" type="password" class="w-full px-4 py-2.5" autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                Konfirmasi Kata Sandi Baru <span class="text-rose-500">*</span>
            </label>
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-2.5" autocomplete="new-password" placeholder="Ulangi kata sandi baru" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>Perbarui Kata Sandi</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200 inline-flex items-center space-x-1"
                >
                    <svg class="w-4 h-4 text-emerald-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Kata sandi berhasil diperbarui.</span>
                </p>
            @endif
        </div>
    </form>
</section>
