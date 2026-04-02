<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter italic font-display">otovend<span class="text-primary not-italic">.pl</span></span>
                    </a>
                </div>
                <!-- Search Bar (eCommerce Style) -->
                <div class="hidden md:flex flex-1 max-w-2xl mx-8 items-center">
                    <form action="{{ route('home') }}" method="GET" class="w-full relative">
                        <input type="text" name="location" placeholder="{{ __('messages.nav.search_placeholder') }}" class="w-full bg-gray-100 dark:bg-gray-900 border-transparent focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 rounded-full py-2.5 pl-5 pr-12 text-sm text-gray-900 dark:text-white transition-all shadow-inner">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 bg-primary text-white rounded-full hover:bg-primary-dark transition shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Language Switcher -->
            <div class="hidden sm:flex items-center space-x-4 bg-gray-50 dark:bg-gray-900/50 p-1.5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-inner">
                <a href="{{ route('set-language', 'pl') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-xl transition-all {{ app()->getLocale() == 'pl' ? 'bg-white shadow-sm ring-1 ring-gray-100' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <img src="https://flagcdn.com/w40/pl.png" class="w-5 h-3.5 object-cover rounded-sm shadow-sm" alt="PL">
                    <span class="text-xs font-black {{ app()->getLocale() == 'pl' ? 'text-primary' : 'text-gray-400' }}">PL</span>
                </a>
                <a href="{{ route('set-language', 'en') }}" class="flex items-center gap-2 px-3 py-1.5 rounded-xl transition-all {{ app()->getLocale() == 'en' ? 'bg-white shadow-sm ring-1 ring-gray-100' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <img src="https://flagcdn.com/w40/gb.png" class="w-5 h-3.5 object-cover rounded-sm shadow-sm" alt="EN">
                    <span class="text-xs font-black {{ app()->getLocale() == 'en' ? 'text-primary' : 'text-gray-400' }}">EN</span>
                </a>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center space-x-4">
                @php
                    $sellRoute = route('vendor.join');
                    if(auth()->check() && auth()->user()->role == 'vendor'){
                        $sellRoute = route('vendor.products.create');
                    }
                @endphp
                <a href="{{ $sellRoute }}" class="hidden md:flex items-center gap-2 px-6 py-2.5 bg-primary hover:bg-primary-dark text-white rounded-xl font-bold text-sm shadow-md transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    {{ __('messages.add_listing') }}
                </a>
                
                <!-- Settings Dropdown -->
                @auth
                <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('messages.profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('messages.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                <x-nav-link :href="route('login')">
                    {{ __('messages.login') }}
                </x-nav-link>
                <x-nav-link :href="route('register')">
                    {{ __('messages.register') }}
                </x-nav-link>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Secondary eCommerce Navigation (Categories & Links) -->
    <div class="hidden md:block bg-gray-50 border-t border-gray-100 dark:bg-gray-900/50 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-12">
                <!-- Links -->
                <div class="flex space-x-6 text-sm font-bold">
                    <a href="{{ route('home') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg> {{ __('messages.nav.all_categories') }}</a>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition">{{ __('messages.nav.admin_panel') }}</a>
                            <a href="{{ route('admin.categories') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition">{{ __('messages.nav.categories') }}</a>
                        @elseif(auth()->user()->role == 'vendor')
                            <a href="{{ route('vendor.dashboard') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition shrink-0">{{ __('messages.nav.my_shop') }}</a>
                        @endif
                        <a href="{{ route('orders.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition shrink-0">{{ __('messages.nav.my_orders') }}</a>
                        <a href="{{ route('favorites.index') }}" class="text-red-500 hover:text-red-600 transition shrink-0 flex items-center gap-1">❤️ {{ __('messages.nav.favorites') }}</a>
                        <a href="{{ route('messages.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-primary transition shrink-0 relative pr-4">
                            {{ __('messages.nav.messages') }}
                            @php $unread = \App\Models\Message::where('receiver_id', auth()->id())->where('is_read', false)->count(); @endphp
                            @if($unread > 0)
                                <span class="absolute -top-3 -right-2 px-1.5 py-0.5 bg-red-500 text-white text-[9px] font-black rounded-full leading-none">{{ $unread }}</span>
                            @endif
                        </a>
                    @endauth
                </div>

                <!-- Right Side Secondary Nav -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('cart.index') }}" class="text-gray-900 dark:text-white font-black flex items-center gap-2 hover:text-primary transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span class="bg-primary/5 text-primary px-2 py-0.5 rounded-md text-xs border border-primary/20 hover:bg-primary/20 transition">{{ count(session('cart', [])) }} {{ __('messages.nav.in_cart') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('messages.home') }}
            </x-responsive-nav-link>
            
            <div class="flex items-center space-x-4 px-4 py-2 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('set-language', 'pl') }}" class="flex items-center gap-2">
                    <img src="https://flagcdn.com/w40/pl.png" class="w-6 h-4 object-cover" alt="PL">
                    <span class="text-sm font-bold {{ app()->getLocale() == 'pl' ? 'text-primary' : 'text-gray-500' }}">Polski</span>
                </a>
                <a href="{{ route('set-language', 'en') }}" class="flex items-center gap-2">
                    <img src="https://flagcdn.com/w40/gb.png" class="w-6 h-4 object-cover" alt="EN">
                    <span class="text-sm font-bold {{ app()->getLocale() == 'en' ? 'text-primary' : 'text-gray-500' }}">English</span>
                </a>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('messages.profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('messages.auth.logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @else
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('messages.login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('messages.register') }}
                </x-responsive-nav-link>
            </div>
            @endauth
        </div>
    </div>
</nav>
