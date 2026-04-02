<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO Meta Tags -->
        <meta name="description" content="@yield('meta_description', 'Otovend.pl - Największa w Polsce giełda maszyn vendingowych, automatów do kawy i części zamiennych. Kupuj i sprzedawaj profesjonalny sprzęt.')">
        <meta name="keywords" content="vending, automaty do kawy, automaty vendingowe, części zamienne, serwis automatów, Otovend, giełda maszyn">
        <meta name="author" content="Otovend.pl">
        
        <!-- OpenGraph Meta Tags -->
        <meta property="og:title" content="@yield('title', 'Otovend | Polska Giełda Vendingowa')">
        <meta property="og:description" content="@yield('meta_description', 'Kupuj i sprzedawaj automaty vendingowe na Otovend.pl')">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

        <title>@yield('title', 'Otovend | Polska Giełda Vendingowa')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- InPost Geowidget -->
        <script src="https://geowidget.inpost.pl/sdk/for-javascript.js"></script>
        <link rel="stylesheet" href="https://geowidget.inpost.pl/sdk/for-javascript.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>

        <!-- Global Toast Notifications -->
        <div class="fixed bottom-4 right-4 z-50 flex flex-col gap-3 pointer-events-none">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     x-transition:enter="transition ease-out duration-300 transform" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100 sm:scale-100" 
                     x-transition:leave-end="opacity-0 sm:scale-95"
                     class="pointer-events-auto bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 max-w-sm">
                    <div class="bg-primary/20 text-primary p-2 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-black uppercase tracking-widest">{{ __('messages.success') ?? 'Sukces' }}</h4>
                        <p class="text-xs font-medium opacity-80">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-gray-400 hover:text-white dark:hover:text-gray-900 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
                     x-transition:enter="transition ease-out duration-300 transform" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100 sm:scale-100" 
                     x-transition:leave-end="opacity-0 sm:scale-95"
                     class="pointer-events-auto bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 max-w-sm">
                    <div class="bg-red-500/20 text-red-500 p-2 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-black uppercase tracking-widest text-red-500">Błąd</h4>
                        <p class="text-xs font-medium opacity-80">{{ session('error') }}</p>
                    </div>
                    <button @click="show = false" class="text-gray-400 hover:text-white dark:hover:text-gray-900 transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                </div>
            @endif
        </div>
    </body>
</html>
