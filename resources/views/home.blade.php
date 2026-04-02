<x-app-layout>
    @section('title', __('messages.home_title') ?? 'Otovend | Giełda Vendingowa')
    @section('meta_description', __('messages.home_meta_desc') ?? 'Kupuj i sprzedawaj automaty vendingowe i ekspresy do kawy na Otovend.pl')
    <!-- Professional eCommerce Hero Banner -->
    <div class="bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-full shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400">{{ __('messages.eco_hero.badge') }}</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 dark:text-white tracking-tight leading-tight">
                        {{ __('messages.eco_hero.title') }}
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 font-medium max-w-lg leading-relaxed">
                        {{ __('messages.eco_hero.subtitle') }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#products-section" class="inline-flex justify-center items-center px-8 py-4 bg-primary hover:bg-primary-dark text-white rounded-xl font-black text-sm uppercase tracking-widest shadow-lg shadow-primary/20 transition-all transform hover:-translate-y-0.5">
                            {{ __('messages.eco_hero.browse') }}
                        </a>
                        <a href="{{ route('vendor.join') }}" class="inline-flex justify-center items-center px-8 py-4 bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary text-gray-900 dark:text-white rounded-xl font-black text-sm uppercase tracking-widest shadow-sm transition-all hover:text-primary">
                            {{ __('messages.eco_hero.start_selling') }}
                        </a>
                    </div>
                    
                    <!-- Trust Signals -->
                    <div class="flex items-center gap-6 pt-6 border-t border-gray-200 dark:border-gray-800">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">{{ __('messages.eco_hero.secure') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">{{ __('messages.eco_hero.sellers_count') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Featured Image / Banner Block -->
                <div class="hidden md:block relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent rounded-3xl blur-2xl transform -translate-y-4 translate-x-4"></div>
                    <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Vending Machines" class="relative rounded-3xl shadow-2xl object-cover h-[500px] w-full border border-gray-100 dark:border-gray-800">
                    
                    <div class="absolute -bottom-6 -left-6 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 flex items-center gap-4">
                        <div class="bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 p-3 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-widest">{{ __('messages.eco_hero.active_offers') }}</div>
                            <div class="text-2xl font-black tracking-tighter text-gray-900 dark:text-white">24,592</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->
    <div class="py-20 bg-white dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight font-display mb-2 uppercase">{{ __('messages.popular_categories') }}</h2>
                    <div class="h-1.5 w-20 bg-primary rounded-full"></div>
                </div>
                <p class="text-gray-400 font-bold max-w-md text-sm uppercase tracking-widest leading-relaxed">{{ __('messages.categories_subtitle') }}</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Vending Machines -->
                <a href="{{ route('home', ['category' => 'Automat vendingowy']) }}" class="group bg-gray-50 dark:bg-gray-900 p-10 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 hover:bg-white dark:hover:bg-gray-800 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 text-center">
                    <div class="w-20 h-20 bg-white dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-6 text-primary shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="font-black text-gray-900 dark:text-white uppercase text-[10px] tracking-widest group-hover:text-primary transition leading-relaxed">{{ __('messages.categories.vending_machines') }}</h3>
                </a>

                <!-- coffee Machines -->
                <a href="{{ route('home', ['category' => 'Ekspres na ziarno']) }}" class="group bg-gray-50 dark:bg-gray-900 p-10 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 hover:bg-white dark:hover:bg-gray-800 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 text-center">
                    <div class="w-20 h-20 bg-white dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-6 text-primary shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <h3 class="font-black text-gray-900 dark:text-white uppercase text-[10px] tracking-widest group-hover:text-primary transition leading-relaxed">{{ __('messages.categories.coffee_machines') }}</h3>
                </a>

                <!-- Stairclimbers -->
                <a href="{{ route('home', ['category' => 'Schodołazy']) }}" class="group bg-gray-50 dark:bg-gray-900 p-10 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 hover:bg-white dark:hover:bg-gray-800 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 text-center">
                    <div class="w-20 h-20 bg-white dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-6 text-primary shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/></svg>
                    </div>
                    <h3 class="font-black text-gray-900 dark:text-white uppercase text-[10px] tracking-widest group-hover:text-primary transition leading-relaxed">{{ __('messages.categories.stairclimbers') }}</h3>
                </a>

                <!-- Parts -->
                <a href="{{ route('home', ['category' => 'Części']) }}" class="group bg-gray-50 dark:bg-gray-900 p-10 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 hover:bg-white dark:hover:bg-gray-800 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 text-center">
                    <div class="w-20 h-20 bg-white dark:bg-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-6 text-primary shadow-lg group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                    </div>
                    <h3 class="font-black text-gray-900 dark:text-white uppercase text-[10px] tracking-widest group-hover:text-primary transition leading-relaxed">{{ __('messages.categories.coin_mechanisms') }}</h3>
                </a>
            </div>
        </div>
    </div>

    <!-- Listings Section -->
    <div class="py-24 bg-white dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ __('messages.latest_listings') }}</h2>
                
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Loading Indicator -->
                    <div id="loading-indicator" class="hidden items-center gap-2 text-primary font-bold text-xs uppercase tracking-widest">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Szukam...
                    </div>
                    
                    <select name="condition" form="search-form" class="bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white text-xs font-bold rounded-xl py-3 px-4 focus:ring-primary appearance-none cursor-pointer">
                        <option value="">Wszystkie stany</option>
                        <option value="new" {{ request('condition') == 'new' ? 'selected' : '' }}>Tylko Nowe</option>
                        <option value="used" {{ request('condition') == 'used' ? 'selected' : '' }}>Tylko Używane</option>
                    </select>

                    <div class="relative">
                        <select name="sort" form="search-form" class="bg-white dark:bg-gray-800 border-2 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white text-xs font-black uppercase tracking-widest rounded-[1.5rem] py-3 pl-5 pr-10 focus:ring-primary focus:border-primary appearance-none cursor-pointer hover:border-gray-200 transition shadow-sm">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Najnowsze</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Najtańsze</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Najdroższe</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div id="product-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 transition-opacity duration-300">
                @include('partials.product_grid')
            </div>
            
            <!-- Eco-Friendly / Sustainable Section -->
            <div class="mt-32 relative overflow-hidden bg-emerald-50/50 dark:bg-emerald-950/20 rounded-[3rem] p-12 md:p-20 border border-emerald-100 dark:border-emerald-900/50">
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-1 space-y-6">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-widest">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.944-.209.385-.315.82-.315 1.288 0 1.246.666 2.054 1.341 2.529.62.436 1.258.46 1.765.342.365-.085.666-.233.914-.42a1 1 0 00.383-1.428l-2.116-3.87zm-7.666 0a1 1 0 011.45-.385c.345.23.614.558.822.944.209.385.315.82-.315 1.288 0 1.246-.666 2.054-1.341 2.529-.62.436 1.258.46-1.765.342-.365-.085-.666-.233-.914-.42a1 1 0 01-.383-1.428l2.116-3.87zM4.1 8a1 1 0 011.1 1v1h2a1 1 0 010 2h-2v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1V9a1 1 0 011.1-1z" clip-rule="evenodd"></path></svg>
                            Eco-Friendly Focus
                        </div>
                        <h2 class="text-4xl font-black text-gray-900 dark:text-white font-display uppercase tracking-tight">
                            {{ __('messages.eco_friendly_tag') }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">
                            {{ __('messages.sustainable_vending') }}
                        </p>
                    </div>
                    <div class="flex-shrink-0 w-full md:w-auto">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-emerald-50 dark:border-emerald-900/20">
                                <span class="text-3xl block mb-2">♻️</span>
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm">Refurbishment</h3>
                            </div>
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-emerald-50 dark:border-emerald-900/20">
                                <span class="text-3xl block mb-2">🍃</span>
                                <h3 class="font-bold text-gray-900 dark:text-white text-sm">Lower Waste</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Section -->
            <div class="mt-32 p-12 md:p-20 bg-gray-900 rounded-[3rem] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-[100px]"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
                    <div class="lg:col-span-2 space-y-8 text-center md:text-left">
                        <h2 class="text-5xl md:text-6xl font-black text-white uppercase tracking-tight font-display leading-[0.9]">
                            {{ __('messages.trust_section.title') }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                            <div class="flex items-center gap-4">
                                <div class="bg-white/10 p-3 rounded-2xl text-primary">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="text-left">
                                    <div class="text-white font-black text-sm uppercase tracking-widest">{{ __('messages.trust_section.listings') }}</div>
                                    <div class="text-gray-400 text-xs">{{ __('messages.trust_section.listings_sub') }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="bg-white/10 p-3 rounded-2xl text-primary">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="text-left">
                                    <div class="text-white font-black text-sm uppercase tracking-widest">{{ __('messages.trust_section.sales') }}</div>
                                    <div class="text-gray-400 text-xs">{{ __('messages.trust_section.sales_sub') }}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="bg-white/10 p-3 rounded-2xl text-primary">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="text-left">
                                    <div class="text-white font-black text-sm uppercase tracking-widest">{{ __('messages.trust_section.support') }}</div>
                                    <div class="text-gray-400 text-xs">{{ __('messages.trust_section.support_sub') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                         <a href="{{ route('vendor.join') }}" class="inline-block px-12 py-6 bg-primary hover:bg-primary-dark text-white rounded-[2rem] font-black text-xl shadow-2xl shadow-primary/40 transition-all transform active:scale-95 uppercase tracking-tight">
                            {{ __('messages.trust_section.cta') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('search-form');
            const productGrid = document.getElementById('product-grid');
            const loadIndicator = document.getElementById('loading-indicator');
            let timeout = null;

            // Handle input changes
            const inputs = searchForm.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(fetchProducts, 500); // 500ms debounce
                });
                
                // For select, trigger immediately
                if (input.tagName === 'SELECT') {
                    input.addEventListener('change', fetchProducts);
                }
            });

            // Handle form submit (prevent normal submission)
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchProducts();
            });

            // Handle ajax pagination clicks
            document.body.addEventListener('click', function(e) {
                let link = e.target.closest('.ajax-pagination a');
                if (link) {
                    e.preventDefault();
                    fetchProducts(link.href);
                }
            });

            function fetchProducts(url) {
                const formData = new FormData(searchForm);
                const queryParams = new URLSearchParams(formData).toString();
                const targetUrl = url || `${searchForm.action}?${queryParams}`;

                // Show loading
                loadIndicator.classList.remove('hidden');
                loadIndicator.classList.add('flex');
                productGrid.style.opacity = '0.5';

                fetch(targetUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    productGrid.innerHTML = html;
                    // Update URL silently
                    window.history.pushState({}, '', targetUrl);
                })
                .finally(() => {
                    // Hide loading
                    loadIndicator.classList.add('hidden');
                    loadIndicator.classList.remove('flex');
                    productGrid.style.opacity = '1';
                });
            }
        });
    </script>
</x-app-layout>
