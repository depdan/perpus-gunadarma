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
    <body class="font-sans antialiased bg-[#F8FAFC] min-h-screen text-slate-800 p-4 sm:p-6 flex flex-col justify-center items-center selection:bg-royal-700 selection:text-white relative overflow-x-hidden">
        <!-- Subtle Academic Decorative Background Glow -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-72 bg-gradient-to-b from-royal-100/50 via-royal-50/20 to-transparent blur-3xl pointer-events-none"></div>

        <!-- Main Guest Container -->
        <div class="w-full max-w-md mx-auto my-auto py-6 relative z-10">
            <!-- Brand Logo & Header -->
            <div class="mb-6 flex flex-col items-center text-center">
                <a href="{{ url('/') }}" class="flex flex-col items-center group">
                    <div class="w-16 h-16 rounded-2xl bg-royal-50 border border-royal-200/80 p-2 shadow-royal-xs transition-transform duration-200 group-hover:scale-105 mb-2.5 flex items-center justify-center">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo Gunadarma" class="w-full h-full object-contain">
                    </div>
                    <div class="flex flex-col items-center leading-tight">
                        <span class="font-extrabold text-lg sm:text-xl tracking-wider text-slate-900 uppercase">GUNADARMA</span>
                        <span class="text-xs font-extrabold tracking-widest uppercase text-royal-700 mt-0.5">PERPUSTAKAAN DIGITAL</span>
                    </div>
                </a>
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-3xl p-7 sm:p-9 shadow-card border border-slate-200/80">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center text-xs text-slate-400 font-medium">
                &copy; {{ date('Y') }} Perpustakaan Universitas Gunadarma.
            </div>
        </div>
    </body>
</html>
