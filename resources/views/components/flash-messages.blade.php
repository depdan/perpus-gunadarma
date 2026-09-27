@if (session('success'))
    <div class="p-4 text-emerald-900 bg-emerald-50 border border-emerald-200 rounded-2xl shadow-xs transition-all flex items-center" role="alert">
        <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mr-3.5 flex-shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="text-xs sm:text-sm font-bold">{{ session('success') }}</div>
    </div>
@endif

@if (session('error'))
    <div class="p-4 text-rose-900 bg-rose-50 border border-rose-200 rounded-2xl shadow-xs transition-all flex items-center" role="alert">
        <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center mr-3.5 flex-shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="text-xs sm:text-sm font-bold">{{ session('error') }}</div>
    </div>
@endif

@if (session('info'))
    <div class="p-4 text-royal-950 bg-royal-50 border border-royal-200 rounded-2xl shadow-xs transition-all flex items-center" role="alert">
        <div class="w-8 h-8 rounded-xl bg-royal-100 text-royal-700 flex items-center justify-center mr-3.5 flex-shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="text-xs sm:text-sm font-bold">{{ session('info') }}</div>
    </div>
@endif

@if ($errors->any())
    <div class="p-4 text-rose-900 bg-rose-50 border border-rose-200 rounded-2xl shadow-xs">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-rose-600 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-bold text-xs sm:text-sm">Terdapat beberapa kesalahan:</span>
        </div>
        <ul class="list-disc list-inside text-xs pl-2 space-y-1 font-medium">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
