@forelse($products as $product)
    <div class="group bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 hover:shadow-xl transition-all duration-300 relative flex flex-col h-full">
        <!-- Wishlist Icon Wrapper -->
        @auth
        @php $isFav = Auth::user()->favorites()->where('product_id', $product->id)->exists(); @endphp
        <form action="{{ route('favorites.toggle', $product) }}" method="POST" class="absolute top-3 right-3 z-20">
            @csrf
            <button type="submit" class="w-8 h-8 rounded-full bg-white/90 dark:bg-gray-900/90 shadow-sm flex items-center justify-center hover:scale-110 transition">
                <svg class="w-4 h-4 {{ $isFav ? 'text-red-500 fill-current' : 'text-gray-400 hover:text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
        </form>
        @endauth
        
        <a href="{{ route('products.show', $product->id) }}" class="block aspect-square relative overflow-hidden bg-gray-50 border-b border-gray-100 dark:border-gray-800">
            @php
                $imgSrc = $product->image;
                if ($product->images && $product->images->count() > 0) {
                    $imgSrc = $product->images->where('is_primary', true)->first()->image_path ?? $product->images->first()->image_path;
                }
            @endphp
            <img src="{{ $imgSrc ?? 'https://via.placeholder.com/400' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
            <div class="absolute top-3 left-3 flex flex-col gap-2">
                <span class="bg-gray-900 text-white px-2.5 py-1 rounded bg-opacity-90 text-[10px] font-bold uppercase tracking-widest shadow-sm">
                    {{ $product->condition == 'new' ? __('messages.new') : __('messages.used') }}
                </span>
            </div>
        </a>
        
        <div class="p-5 flex flex-col flex-1">
            <!-- Vendor Info & Stars -->
            <div class="flex items-center justify-between mb-2">
                <a href="{{ route('products.show', $product->id) }}" class="text-[10px] text-gray-500 font-bold tracking-widest uppercase hover:text-primary transition truncate max-w-[150px]">{{ $product->vendor->shop_name ?? __('messages.product_card.vendor') }}</a>
                <div class="flex items-center gap-1 bg-yellow-50 dark:bg-yellow-900/20 px-1.5 py-0.5 rounded text-[10px] font-black text-yellow-600 dark:text-yellow-500">
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    {{ number_format($product->vendor->average_rating ?? 5.0, 1) }}
                </div>
            </div>

            <a href="{{ route('products.show', $product->id) }}" class="font-bold text-gray-900 dark:text-white uppercase tracking-tight mb-2 group-hover:text-primary transition text-sm line-clamp-2 leading-tight flex-1">
                {{ $product->name }}
            </a>
            
            <div class="flex items-center gap-1.5 mb-4 mt-auto">
                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span class="text-[10px] text-gray-400 font-bold tracking-wider uppercase truncate">{{ $product->location ?? __('messages.poland') }}</span>
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-between items-end gap-3">
                <div class="flex flex-col">
                    <span class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mb-0.5">{{ __('messages.product_card.gross_price') }}</span>
                    <span class="text-xl font-black text-primary tracking-tighter">{{ number_format($product->price, 2, ',', ' ') }} <span class="text-[10px]">PLN</span></span>
                </div>
                
                <!-- Quick Add to Cart -->
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-100 hover:bg-primary dark:bg-gray-800 dark:hover:bg-primary text-gray-900 hover:text-white dark:text-white w-10 h-10 rounded-xl flex items-center justify-center transition-colors shadow-sm group/cartbtn">
                        <svg class="w-5 h-5 group-hover/cartbtn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m-2-2h4"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full py-20 text-center flex flex-col items-center justify-center">
        <div class="w-20 h-20 bg-gray-50 dark:bg-gray-900 rounded-[2rem] flex items-center justify-center text-gray-300 mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-2">{{ __('messages.product_card.no_results') }}</h3>
        <p class="text-gray-400 text-sm font-bold tracking-widest uppercase">{{ __('messages.product_card.change_filters') }}</p>
    </div>
@endforelse

<!-- Pagination Links -->
@if($products->hasPages())
<div class="col-span-full pt-8 flex justify-center w-full ajax-pagination">
    {{ $products->appends(request()->query())->links() }}
</div>
@endif
