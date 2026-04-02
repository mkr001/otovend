<x-app-layout>
    <div class="bg-gray-50 dark:bg-gray-950 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-sm font-medium text-gray-500" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-primary transition uppercase tracking-widest text-[10px] font-black">{{ __('messages.home') }}</a>
                    </li>
                    @if($product->category)
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('home', ['category' => $product->category]) }}" class="hover:text-primary transition uppercase tracking-widest text-[10px] font-black">
                                {{ __('messages.category_map.' . $product->category) ?? $product->category }}
                            </a>
                        </div>
                    </li>
                    @endif
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="text-gray-400 truncate max-w-[200px] uppercase tracking-widest text-[10px] font-black italic">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-10">
                <!-- Image Carousel Gallery -->
                @php
                    $allImages = $product->images->count() > 0 
                        ? $product->images->pluck('image_path') 
                        : collect([$product->image ?? 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&q=80&w=1200']);
                @endphp

                <div class="bg-white dark:bg-gray-800 rounded-[3rem] overflow-hidden shadow-2xl border border-gray-100 dark:border-gray-700">
                    <!-- Main Image Viewer -->
                    <div class="relative group" id="main-image-wrapper">
                        <img id="main-gallery-img" src="{{ $allImages->first() }}" alt="{{ $product->name }}" class="w-full h-auto max-h-[600px] object-cover transition-all duration-700">
                        <div class="absolute top-8 left-8">
                            <span class="bg-primary text-white px-6 py-2 rounded-full text-xs font-black uppercase tracking-[0.2em] shadow-2xl shadow-primary/40">
                                {{ $product->condition == 'new' ? __('messages.new') : __('messages.used') }}
                            </span>
                        </div>
                        @if($allImages->count() > 1)
                            <!-- Navigation Arrows -->
                            <button onclick="changeImage(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 dark:bg-gray-900/90 backdrop-blur rounded-2xl shadow-xl flex items-center justify-center text-gray-700 dark:text-white hover:bg-white transition hover:scale-110 group/btn">
                                <svg class="w-5 h-5 transform group-hover/btn:-translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button onclick="changeImage(1)" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 dark:bg-gray-900/90 backdrop-blur rounded-2xl shadow-xl flex items-center justify-center text-gray-700 dark:text-white hover:bg-white transition hover:scale-110 group/btn">
                                <svg class="w-5 h-5 transform group-hover/btn:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                            <!-- Counter -->
                            <div id="image-counter" class="absolute bottom-6 right-6 bg-black/60 backdrop-blur text-white text-xs font-black px-4 py-1.5 rounded-full tracking-widest">
                                1 / {{ $allImages->count() }}
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Strip -->
                    @if($allImages->count() > 1)
                    <div class="flex gap-3 p-5 overflow-x-auto bg-gray-50 dark:bg-gray-900/50 scrollbar-thin">
                        @foreach($allImages as $i => $imgPath)
                            <button onclick="selectImage({{ $i }})" class="gallery-thumb flex-shrink-0 w-20 h-20 rounded-2xl overflow-hidden border-2 transition-all {{ $i === 0 ? 'border-primary ring-2 ring-primary/40 scale-105' : 'border-gray-200 dark:border-gray-700 hover:border-primary/50 hover:scale-105' }}">
                                <img src="{{ $imgPath }}" alt="Thumbnail {{ $i + 1 }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                    <!-- Description & Stats -->
                    <div class="bg-white dark:bg-gray-800 rounded-[3rem] p-10 lg:p-16 shadow-sm border border-gray-100 dark:border-gray-700">
                        <div class="flex flex-wrap items-center gap-6 mb-12 overflow-x-auto pb-6">
                            <div class="bg-gray-50 dark:bg-gray-950/50 px-8 py-5 rounded-[2rem] border border-gray-100 dark:border-gray-700 min-w-[160px] shadow-inner">
                                <div class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mb-2">{{ __('messages.create_product.year') }}</div>
                                <div class="text-xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $product->year ?? 'Brak' }}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-950/50 px-8 py-5 rounded-[2rem] border border-gray-100 dark:border-gray-700 min-w-[160px] shadow-inner">
                                <div class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mb-2">{{ __('messages.create_product.condition') }}</div>
                                <div class="text-xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $product->condition == 'new' ? __('messages.new') : __('messages.used') }}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-950/50 px-8 py-5 rounded-[2rem] border border-gray-100 dark:border-gray-700 min-w-[160px] shadow-inner">
                                <div class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mb-2">{{ __('messages.create_product.location') }}</div>
                                <div class="text-xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $product->location ?? 'Polska' }}</div>
                            </div>
                        </div>

                        <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-8 uppercase tracking-tighter font-display leading-none">{{ __('messages.create_product.desc') }}</h2>
                        <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400 leading-relaxed text-xl whitespace-pre-line font-medium border-t border-gray-50 dark:border-gray-700 pt-10">
                            {{ $product->description }}
                        </div>
                    </div>
                </div>

                <!-- Right: Price & Vendor -->
                <div class="space-y-8">
                    <!-- Price Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-[3rem] p-10 shadow-[0_64px_96px_-16px_rgba(0,0,0,0.12)] border border-gray-100 dark:border-gray-700 sticky top-24 overflow-hidden relative group">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-1000"></div>
                        
                        <h1 class="text-4xl font-black text-gray-900 dark:text-white mb-6 leading-[0.9] tracking-tighter font-display uppercase">{{ $product->name }}</h1>
                        
                        <div class="mb-10 bg-gray-50 dark:bg-gray-950/50 p-6 rounded-[2rem] border border-gray-100 dark:border-gray-700 shadow-inner">
                            <div class="text-gray-400 text-[10px] font-black uppercase tracking-[0.3em] mb-2">{{ __('messages.product_card.gross_price') }}</div>
                            <div class="flex items-baseline gap-2">
                                <span class="text-6xl font-black text-primary tracking-tighter">{{ number_format($product->price, 0, '.', ' ') }}</span>
                                <span class="text-xl font-black text-primary tracking-widest">PLN</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-6 rounded-[2rem] font-black text-2xl shadow-2xl shadow-primary/30 transform active:scale-95 transition-all flex items-center justify-center gap-4 group">
                                    <svg class="w-7 h-7 transform group-hover:rotate-12 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.25 2.25c-.63.63-.18 1.35.44 1.35h12m-12 0a1 1 0 100 2 1 1 0 000-2zm10 0a1 1 0 100 2 1 1 0 000-2z"/></svg>
                                    {{ __('messages.cart') }}
                                </button>
                            </form>
                            @auth
                            @php $isFav = Auth::user()->favorites()->where('product_id', $product->id)->exists(); @endphp
                            <form action="{{ route('favorites.toggle', $product) }}" method="POST" id="fav-form">
                                @csrf
                                <button type="submit" id="fav-btn" class="w-full border-2 {{ $isFav ? 'border-red-400 bg-red-50 dark:bg-red-900/20 text-red-500' : 'border-gray-100 dark:border-gray-700 text-gray-400' }} py-5 rounded-[2rem] font-black text-xs uppercase tracking-widest hover:border-red-400 hover:text-red-500 transition flex items-center justify-center gap-3 group/fav">
                                    <svg class="w-5 h-5 transition group-hover/fav:scale-125 {{ $isFav ? 'fill-current' : '' }}" fill="{{ $isFav ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    {{ $isFav ? '❤️' : __('messages.product_show.favorite') }}
                                </button>
                            </form>

                            <a href="{{ route('messages.show', ['contact' => $product->vendor->user_id, 'product' => $product->id]) }}" class="w-full border-2 border-gray-100 dark:border-gray-700 text-gray-500 dark:text-gray-400 py-5 rounded-[2rem] font-black text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-900 transition flex items-center justify-center gap-3 decoration-transparent">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ __('messages.product_show.send_message') }}
                            </a>
                            @endauth
                        </div>

                        <div class="mt-12 pt-10 border-t border-gray-50 dark:border-gray-700">
                            <div class="flex items-center gap-5 mb-8">
                                <div class="w-16 h-16 bg-primary text-white rounded-[1.5rem] flex items-center justify-center font-black text-3xl shadow-xl shadow-primary/20">
                                    {{ substr($product->vendor->shop_name, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="font-black text-gray-900 dark:text-white uppercase tracking-tight text-lg">{{ $product->vendor->shop_name }}</h3>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ __('messages.seller_since') }} {{ $product->vendor->created_at->format('Y') }}r.</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 text-gray-600 dark:text-white font-black uppercase text-[10px] tracking-widest bg-gray-50 dark:bg-gray-950/50 p-5 rounded-2xl border border-gray-100 dark:border-gray-700">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $product->location ?? 'Polska' }}
                                </div>
                                <div class="bg-gray-900 text-white p-5 rounded-2xl flex items-center justify-between group cursor-pointer hover:bg-black transition-all shadow-xl shadow-black/10" onclick="alert('{{ $product->vendor->phone ?? 'Contact seller via message' }}')">
                                    <div class="text-white font-black uppercase text-[10px] tracking-[0.2em]">{{ __('messages.show_phone') }}</div>
                                    <svg class="w-5 h-5 text-primary transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- REVIEWS SECTION -->
                        <div class="mt-12 pt-10 border-t border-gray-50 dark:border-gray-700">
                            <h3 class="font-black text-gray-900 dark:text-white uppercase tracking-tight text-xl mb-6">{{ __('messages.product_show.reviews') }} ({{ number_format($product->vendor->average_rating, 1) }} ⭐)</h3>
                            
                            @auth
                                @php
                                    $hasBought = Auth::user()->orders()->whereHas('items.product', function ($q) use ($product) {
                                        $q->where('vendor_id', $product->vendor_id);
                                    })->exists();
                                    $hasReviewed = Auth::user()->reviews()->where('vendor_id', $product->vendor_id)->where('product_id', $product->id)->exists();
                                @endphp

                                @if($hasBought && !$hasReviewed)
                                    <form action="{{ route('reviews.store', ['vendor' => $product->vendor_id, 'product' => $product->id]) }}" method="POST" class="bg-gray-50 dark:bg-gray-900 p-6 rounded-2xl border border-gray-100 dark:border-gray-800 mb-8">
                                        @csrf
                                        <h4 class="font-bold text-gray-900 dark:text-white text-sm uppercase tracking-widest mb-4">{{ __('messages.product_show.write_review') }}</h4>
                                        <div class="flex gap-2 mb-4">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                                    <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-300 transition" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                </label>
                                            @endfor
                                        </div>
                                        <textarea name="comment" rows="3" placeholder="{{ __('messages.product_show.message_placeholder') }}" class="w-full bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl mb-4 text-sm p-4 focus:border-primary focus:ring-primary"></textarea>
                                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-full font-black text-[10px] uppercase tracking-widest shadow-lg shadow-primary/20 transition">{{ __('messages.product_show.submit_review') }}</button>
                                    </form>
                                @elseif($hasReviewed)
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl text-center text-[10px] font-black uppercase tracking-widest text-primary mb-8 border border-primary/20">Dziękujemy za dodanie opinii.</div>
                                @else
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-xl text-center text-[10px] font-black uppercase tracking-widest text-gray-400 mb-8">Kup ten produkt by dodać opinię.</div>
                                @endif
                            @endauth

                            <div class="space-y-4">
                                @forelse($product->vendor->reviews()->latest()->take(5)->get() as $review)
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                                        <div class="flex items-start justify-between mb-2">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-900 flex items-center justify-center font-bold text-xs text-primary">{{ substr($review->user->name, 0, 1) }}</div>
                                                <div>
                                                    <div class="text-xs font-black text-gray-900 dark:text-white uppercase tracking-wider">{{ $review->user->name }}</div>
                                                    <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $review->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                            <div class="flex gap-1 text-yellow-400">
                                                @for($i = 0; $i < $review->rating; $i++)
                                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                @endfor
                                            </div>
                                        </div>
                                        @if($review->comment)
                                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $review->comment }}</p>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center text-gray-400 font-bold text-xs uppercase tracking-widest py-8">{{ __('messages.messages_keys.no_messages') }}</div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@php $allImagesList = $product->images->count() > 0 ? $product->images->pluck('image_path')->values()->toJson() : json_encode([$product->image ?? '']); @endphp
<script>
    const galleryImages = @json($product->images->count() > 0 ? $product->images->pluck('image_path')->values() : collect([$product->image ?? '']));
    let currentIndex = 0;

    function selectImage(index) {
        currentIndex = index;
        const mainImg = document.getElementById('main-gallery-img');
        const counter = document.getElementById('image-counter');
        const thumbs = document.querySelectorAll('.gallery-thumb');

        // Fade transition
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = galleryImages[index];
            mainImg.style.opacity = '1';
        }, 200);

        if (counter) counter.textContent = (index + 1) + ' / ' + galleryImages.length;

        // Update thumbnail borders
        thumbs.forEach((thumb, i) => {
            thumb.className = thumb.className
                .replace('border-primary ring-2 ring-primary/40 scale-105', '')
                .replace('border-gray-200 dark:border-gray-700', '');
            if (i === index) {
                thumb.classList.add('border-primary', 'ring-2', 'ring-primary/40', 'scale-105');
            } else {
                thumb.classList.add('border-gray-200', 'dark:border-gray-700');
            }
        });
    }

    function changeImage(dir) {
        const newIndex = (currentIndex + dir + galleryImages.length) % galleryImages.length;
        selectImage(newIndex);
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') changeImage(-1);
        if (e.key === 'ArrowRight') changeImage(1);
    });

    // Smooth fade transition style
    const mainImg = document.getElementById('main-gallery-img');
    if (mainImg) mainImg.style.transition = 'opacity 0.2s ease';
</script>
