<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Verifikasi Alamat Email</h2>
        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, silakan periksa kotak masuk email Anda dan klik tautan verifikasi yang telah kami kirimkan.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 rounded-xl font-bold text-xs text-emerald-700">
            Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda daftarkan.
        </div>
    @endif

    <div class="space-y-4 pt-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full py-3 px-4 btn-primary-royal rounded-xl text-xs sm:text-sm font-bold shadow-royal-sm cursor-pointer">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-xs text-slate-500 hover:text-rose-600 font-bold underline cursor-pointer">
                Keluar (Log Out)
            </button>
        </form>
    </div>
</x-guest-layout>
