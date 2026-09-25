<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Sistem Masuk Perpustakaan</h2>
        <p class="text-xs text-slate-500 mt-1">Silakan masuk menggunakan akun civitas akademik Gunadarma</p>
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
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Password</label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-600 focus:bg-white transition" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-xs">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-purple-700 shadow-xs focus:ring-purple-500" name="remember">
                <span class="ms-2 text-slate-600">Ingat saya</span>
            </label>

            <a href="{{ route('register') }}" class="text-purple-700 hover:text-purple-900 font-semibold">
                Daftar akun peminjam
            </a>
        </div>

        <button type="submit"
                class="w-full py-3 px-4 bg-purple-900 hover:bg-purple-800 text-white font-bold rounded-xl text-sm shadow-md transition">
            Masuk ke Sistem
        </button>
    </form>

    <!-- Demo Credentials Helper for Technical Test Reviewer -->
    <div class="mt-6 pt-4 border-t border-slate-100 text-xs">
        <p class="font-bold text-slate-700 mb-2 text-center text-[11px] uppercase tracking-wider">Kredensial Akun Demo (Technical Test):</p>
        <div class="grid grid-cols-2 gap-2">
            <button type="button"
                    onclick="document.getElementById('email').value='admin@gunadarma.ac.id'; document.getElementById('password').value='password';"
                    class="p-2.5 bg-purple-50 border border-purple-200 rounded-xl text-left hover:bg-purple-100 transition cursor-pointer">
                <div class="font-bold text-purple-900">👑 Akun Admin</div>
                <div class="text-[10px] text-purple-700">admin@gunadarma.ac.id</div>
                <div class="text-[10px] text-slate-500">pass: password</div>
            </button>

            <button type="button"
                    onclick="document.getElementById('email').value='budi@gunadarma.ac.id'; document.getElementById('password').value='password';"
                    class="p-2.5 bg-blue-50 border border-blue-200 rounded-xl text-left hover:bg-blue-100 transition cursor-pointer">
                <div class="font-bold text-blue-900">👤 Akun Peminjam</div>
                <div class="text-[10px] text-blue-700">budi@gunadarma.ac.id</div>
                <div class="text-[10px] text-slate-500">pass: password</div>
            </button>
        </div>
    </div>
</x-guest-layout>
