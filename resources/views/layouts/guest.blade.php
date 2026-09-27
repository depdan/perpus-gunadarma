<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Perpustakaan Universitas Gunadarma') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F8FAFC] min-h-screen text-slate-800 p-4 sm:p-6 flex flex-col justify-center items-center selection:bg-royal-700 selection:text-white">
        <!-- Main Guest Container -->
        <div class="w-full max-w-md mx-auto my-auto py-8">
            <!-- Brand Logo -->
            <div class="mb-6 flex flex-col items-center text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center space-x-3 mb-2 group">
                    <div class="w-12 h-12 rounded-2xl overflow-hidden flex items-center justify-center bg-royal-50 border border-royal-200/80 p-1.5 shadow-royal-sm transition-transform duration-200 group-hover:scale-105">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-full h-full object-contain rounded-xl">
                    </div>
                    <div class="flex flex-col text-left leading-tight">
                        <div class="flex items-center space-x-1.5">
                            <span class="font-extrabold text-base tracking-wider text-slate-900 uppercase">GUNADARMA</span>
                            <span class="text-[10px] font-extrabold px-1.5 py-0.5 rounded-md bg-royal-700 text-white">LIB</span>
                        </div>
                        <span class="text-[11px] font-bold tracking-wider uppercase text-royal-700">PERPUSTAKAAN DIGITAL</span>
                    </div>
                </a>
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-2xl p-7 sm:p-9 shadow-xs border border-slate-200/80">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center text-xs text-slate-400 font-medium">
                &copy; {{ date('Y') }} Perpustakaan Universitas Gunadarma.
            </div>
        </div>
    </body>
</html>
