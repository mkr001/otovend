<x-app-layout>
    <div class="bg-gray-50 dark:bg-gray-950 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h1 class="text-5xl font-black text-gray-900 dark:text-white uppercase tracking-tighter font-display leading-none">
                        ❤️ Ulubione
                    </h1>
                    <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-[10px] mt-2">
                        {{ $favorites->count() }} {{ $favorites->count() === 1 ? 'ogłoszenie' : 'ogłoszeń' }} zapisanych
                    </p>
                </div>
                <a href="{{ route('home') }}" class="px-6 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 rounded-2xl font-black text-xs uppercase tracking-widest hover:border-primary hover:text-primary transition flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Przeglądaj oferty
                </a>
            </div>

            @if($favorites->isEmpty())
                <!-- Empty State -->
                <div class="flex flex-col items-center justify-center py-32 text-center">
                    <div class="w-32 h-32 bg-white dark:bg-gray-800 rounded-[3rem] flex items-center justify-center mx-auto mb-8 shadow-xl border border-gray-100 dark:border-gray-700">
                        <svg class="w-16 h-16 text-gray-200 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-3">Brak ulubionych</h2>
                    <p class="text-gray-400 font-medium mb-8 max-w-sm">Kliknij serce ❤️ na dowolnej maszynie, aby dodać ją do swojej listy.</p>
                    <a href="{{ route('home') }}" class="bg-primary text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-primary-dark transition shadow-xl shadow-primary/30">
                        Przeglądaj katalog
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($favorites as $fav)
                        @php $product = $fav->product; @endphp
                        @if($product)
                        <div class="group bg-white dark:bg-gray-800 rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative">
                            <!-- Remove Favorite Button -->
                            <form action="{{ route('favorites.toggle', $product) }}" method="POST" class="absolute top-4 right-4 z-10">
                                @csrf
                                <button type="submit" class="w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center shadow-lg hover:bg-red-600 transition hover:scale-110">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </button>
                            </form>

                            <!-- Product Image -->
                            <a href="{{ route('products.show', $product) }}">
                                <div class="relative h-52 overflow-hidden bg-gray-100 dark:bg-gray-900">
                                    <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&q=80&w=600' }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                    <div class="absolute bottom-3 left-3">
                                        <span class="bg-black/60 backdrop-blur text-white px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest">
                                            {{ $product->condition == 'new' ? 'Nowy' : 'Używany' }}
                                        </span>
                                    </div>
                                </div>
                            </a>

                            <!-- Product Info -->
                            <div class="p-6">
                                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.2em] mb-1">{{ $product->vendor->shop_name ?? '—' }}</p>
                                <a href="{{ route('products.show', $product) }}">
                                    <h3 class="text-lg font-black text-gray-900 dark:text-white truncate hover:text-primary transition uppercase tracking-tight">{{ $product->name }}</h3>
                                </a>
                                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50 dark:border-gray-700">
                                    <div>
                                        <div class="text-2xl font-black text-primary tracking-tighter">{{ number_format($product->price, 0, '.', ' ') }} <span class="text-base">PLN</span></div>
                                        <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $product->location ?? 'Polska' }}</div>
                                    </div>
                                    <a href="{{ route('products.show', $product) }}" class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/30 hover:bg-primary-dark transition hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
