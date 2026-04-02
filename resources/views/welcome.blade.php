<x-app-layout>
    <!-- Hero Section (Otomoto Style) -->
    <div class="relative bg-gray-100 pt-8 pb-12 lg:pt-16 lg:pb-24">
        <!-- Background Image -->
        <div class="absolute inset-0 h-[400px] lg:h-[500px]">
            <img src="https://images.unsplash.com/photo-1556740758-90de374c12ad?auto=format&fit=crop&q=80" class="w-full h-full object-cover" alt="Vending Background">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-gray-900/20"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            <!-- Main Search Container -->
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden mt-8 lg:mt-16">
                <!-- Tabs Structure (Top nav inside form) -->
                <div class="flex border-b border-gray-100 overflow-x-auto scrollbar-hide bg-gray-50">
                    <button class="px-6 md:px-10 py-5 text-sm font-black text-gray-900 border-b-4 border-primary bg-white whitespace-nowrap uppercase tracking-wider">
                        {{ __('messages.all_categories') }}
                    </button>
                    @foreach($categories->take(2) as $cat)
                        <button class="px-6 md:px-10 py-5 text-sm font-bold text-gray-500 hover:text-gray-900 border-b-4 border-transparent hover:border-gray-300 transition bg-transparent whitespace-nowrap uppercase tracking-wider">
                            {{ __('messages.category_map.'.$cat) ?? $cat }}
                        </button>
                    @endforeach
                </div>

                <!-- Form Area -->
                <div class="p-6 md:p-8 bg-white">
                    <form action="{{ route('home') }}" method="GET" class="space-y-6">
                        <!-- Upper Inputs Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="relative">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.nav.search_placeholder') }}</label>
                                <input type="text" name="search" value="{{ request('search') }}" class="w-full h-12 bg-white border-2 border-gray-200 focus:border-primary rounded-lg text-sm focus:ring-0 font-bold px-4 transition-colors">
                            </div>

                            <div class="relative">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.nav.categories') }}</label>
                                <select name="category" class="w-full h-12 bg-white border-2 border-gray-200 focus:border-primary rounded-lg text-sm focus:ring-0 font-bold px-4 transition-colors appearance-none">
                                    <option value="">{{ __('messages.all_categories') }}</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ __('messages.category_map.'.$cat) ?? $cat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="relative">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.price_to') }}</label>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" class="w-full h-12 bg-white border-2 border-gray-200 focus:border-primary rounded-lg text-sm focus:ring-0 font-bold px-4 transition-colors">
                            </div>
                        </div>
                        
                        <!-- Bottom Divider & Action -->
                        <div class="flex flex-col-reverse md:flex-row justify-between items-center pt-4 border-t border-gray-100 gap-4">
                            <a href="{{ route('vendor.join') }}" class="text-sm font-bold text-gray-500 hover:text-primary transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                {{ __('messages.eco_hero.start_selling') }}
                            </a>
                            
                            <button type="submit" class="w-full md:w-auto bg-primary hover:bg-primary-dark text-white px-12 h-14 rounded-lg font-black uppercase tracking-widest text-sm transition-all transform active:scale-95 shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                {{ __('messages.search') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="listings" class="py-24 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Category Chips -->
            <div class="flex flex-wrap items-center gap-4 mb-16 overflow-x-auto pb-4 scrollbar-hide">
                <a href="{{ route('home') }}" class="px-6 py-3 {{ !request('category') ? 'bg-primary text-white shadow-xl shadow-primary/20' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400' }} rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                    {{ __('messages.all_categories') }}
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('home', ['category' => $cat]) }}" class="px-6 py-3 {{ request('category') == $cat ? 'bg-primary text-white shadow-xl shadow-primary/20' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400' }} rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                        {{ __('messages.categories.'.strtolower(str_replace(' ', '_', array_search($cat, __('messages.category_map')) ?: $cat))) ?? $cat }}
                    </a>
                @endforeach
            </div>

            <!-- Listings Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm border border-gray-200 dark:border-gray-700 transition-all hover:-translate-y-1 hover:shadow-xl hover:border-primary/50">
                        <div class="relative aspect-[4/5] overflow-hidden">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/400x500' }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-8">
                                <span class="bg-primary text-white px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] self-start transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                    {{ __('messages.see_more') }}
                                </span>
                            </div>
                            <div class="absolute top-6 left-6 flex flex-col gap-2">
                                <span class="bg-gray-950/20 backdrop-blur-md text-white border border-white/20 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest">
                                    {{ $product->condition == 'new' ? __('messages.new') : __('messages.used') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-[10px] font-black text-primary uppercase tracking-widest">{{ __('messages.category_map.'.$product->category) ?? $product->category }}</span>
                                <span class="w-1 h-1 bg-gray-200 rounded-full"></span>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $product->location }}</span>
                            </div>
                            <h3 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-6 leading-tight group-hover:text-primary transition-colors">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.product_card.gross_price') }}</span>
                                    <span class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter">{{ number_format($product->price, 0, '.', ' ') }} <span class="text-xs">PLN</span></span>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded-xl text-gray-400 group-hover:bg-primary group-hover:text-white transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-32 text-center">
                        <div class="bg-white dark:bg-gray-800 inline-flex p-10 rounded-2xl shadow-xl mb-8">
                            <svg class="w-16 h-16 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h2 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-4">
                            {{ __('messages.product_card.no_results') }}
                        </h2>
                        <p class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">
                            {{ __('messages.product_card.change_filters') }}
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
