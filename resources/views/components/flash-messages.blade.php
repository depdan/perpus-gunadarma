@if (session('success'))
    <div class="mb-5 flex items-center p-4 text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-xl shadow-sm transition-all animate-fadeIn" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-emerald-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <div class="text-sm font-medium">{{ session('success') }}</div>
    </div>
@endif

@if (session('error'))
    <div class="mb-5 flex items-center p-4 text-rose-800 bg-rose-50 border border-rose-200 rounded-xl shadow-sm transition-all animate-fadeIn" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-rose-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>
        <div class="text-sm font-medium">{{ session('error') }}</div>
    </div>
@endif

@if (session('info'))
    <div class="mb-5 flex items-center p-4 text-blue-800 bg-blue-50 border border-blue-200 rounded-xl shadow-sm transition-all" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-blue-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <div class="text-sm font-medium">{{ session('info') }}</div>
    </div>
@endif

@if ($errors->any())
    <div class="mb-5 p-4 text-rose-800 bg-rose-50 border border-rose-200 rounded-xl shadow-sm">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-rose-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-semibold text-sm">Terdapat kesalahan pada input form:</span>
        </div>
        <ul class="list-disc list-inside text-sm pl-2 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
