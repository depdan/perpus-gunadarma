<x-guest-layout>
    <div class="mb-5 text-center">
        <h2 class="text-xl font-bold text-slate-900 tracking-tight">Masuk ke Sistem</h2>
        <p class="text-xs text-slate-500 mt-0.5">Sistem Informasi Perpustakaan Gunadarma</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   autocomplete="username"
                   placeholder="nama@gunadarma.ac.id"
                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi</label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white transition" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-xs">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-2xs focus:ring-blue-500" name="remember">
                <span class="ms-2 text-slate-600">Ingat saya</span>
            </label>

            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                Daftar akun peminjam
            </a>
        </div>

        <button type="submit"
                class="w-full py-2.5 px-4 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold rounded-lg text-sm shadow-2xs transition">
            Masuk
        </button>
    </form>

    <!-- Demo Account Helper for Reviewer -->
    <div class="mt-6 pt-4 border-t border-slate-100 text-xs">
        <p class="font-bold text-slate-600 mb-2 text-center text-[11px] uppercase tracking-wider">Kredensial Demo:</p>
        <div class="grid grid-cols-2 gap-2">
            <button type="button"
                    onclick="document.getElementById('email').value='admin@gunadarma.ac.id'; document.getElementById('password').value='password';"
                    class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-left hover:bg-blue-50 hover:border-blue-200 transition cursor-pointer">
                <div class="font-bold text-slate-800">👑 Admin</div>
                <div class="text-[10px] text-slate-600">admin@gunadarma.ac.id</div>
                <div class="text-[10px] text-slate-400">pass: password</div>
            </button>

            <button type="button"
                    onclick="document.getElementById('email').value='budi@gunadarma.ac.id'; document.getElementById('password').value='password';"
                    class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg text-left hover:bg-blue-50 hover:border-blue-200 transition cursor-pointer">
                <div class="font-bold text-slate-800">👤 Peminjam</div>
                <div class="text-[10px] text-slate-600">budi@gunadarma.ac.id</div>
                <div class="text-[10px] text-slate-400">pass: password</div>
            </button>
        </div>
    </div>
</x-guest-layout>
