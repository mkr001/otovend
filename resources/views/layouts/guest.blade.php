<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 dark:text-white bg-white dark:bg-gray-950">
        <div class="min-h-screen flex pl-0 md:pl-0">
            <!-- Left Side: Image/Branding -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-gray-950 items-center justify-center overflow-hidden">
                <div class="absolute inset-0">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&q=80" class="w-full h-full object-cover opacity-30 filter grayscale" alt="Auth Background">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
                </div>
                
                <div class="relative z-10 p-16 text-center">
                    <a href="/" class="inline-block mb-6">
                        <span class="text-6xl font-black text-white tracking-tighter italic font-display">otovend<span class="text-primary not-italic">.pl</span></span>
                    </a>
                    <h2 class="text-3xl font-black text-white uppercase tracking-tight mb-4">Vending Professionals</h2>
                    <p class="text-gray-400 font-bold max-w-md mx-auto">{{ __('messages.eco_hero.subtitle') }}</p>
                </div>
            </div>

            <!-- Right Side: Auth Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 relative bg-gray-50 dark:bg-gray-900">
                
                <!-- Language Switcher Positioned at Top Right -->
                <div class="absolute top-8 right-8 flex gap-2">
                    <a href="{{ route('set-language', 'pl') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition-all {{ app()->getLocale() == 'pl' ? 'bg-white shadow ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700' : 'hover:bg-gray-200 dark:hover:bg-gray-800' }}">
                        <img src="https://flagcdn.com/w40/pl.png" class="w-5 h-3.5 object-cover rounded shadow-sm" alt="PL">
                        <span class="text-xs font-black {{ app()->getLocale() == 'pl' ? 'text-primary' : 'text-gray-400' }}">PL</span>
                    </a>
                    <a href="{{ route('set-language', 'en') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-lg transition-all {{ app()->getLocale() == 'en' ? 'bg-white shadow ring-1 ring-gray-200 dark:bg-gray-800 dark:ring-gray-700' : 'hover:bg-gray-200 dark:hover:bg-gray-800' }}">
                        <img src="https://flagcdn.com/w40/gb.png" class="w-5 h-3.5 object-cover rounded shadow-sm" alt="EN">
                        <span class="text-xs font-black {{ app()->getLocale() == 'en' ? 'text-primary' : 'text-gray-400' }}">EN</span>
                    </a>
                </div>

                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
