<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Konfirmasi Keamanan</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan masukkan kata sandi Anda untuk melanjutkan aksi ini.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi</label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-medium focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 text-slate-900 transition" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <button type="submit"
                class="w-full py-3 px-4 btn-primary-royal rounded-xl text-xs sm:text-sm font-bold shadow-royal-sm cursor-pointer mt-3">
            Konfirmasi Kata Sandi
        </button>
    </form>
</x-guest-layout>
