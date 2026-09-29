<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Lupa Kata Sandi</h2>
        <p class="text-xs text-slate-500 mt-1">Masukkan alamat email Anda untuk menerima tautan reset kata sandi</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                    </svg>
                </div>
                <input id="email"
                       type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       placeholder="nama@gunadarma.ac.id"
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm font-medium focus:bg-white focus:ring-2 focus:ring-royal-500 focus:border-royal-500 text-slate-900 placeholder-slate-400 transition" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <button type="submit"
                class="w-full py-3 px-4 btn-primary-royal rounded-xl text-xs sm:text-sm font-bold shadow-royal-sm cursor-pointer mt-2">
            Kirim Tautan Reset Sandi
        </button>

        <div class="text-center pt-2">
            <a class="text-xs text-slate-500 hover:text-royal-700 font-bold" href="{{ route('login') }}">
                &larr; Kembali ke halaman login
            </a>
        </div>
    </form>
</x-guest-layout>
