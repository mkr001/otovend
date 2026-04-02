<x-app-layout>
    <div class="py-16 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-10 pb-6 border-b border-gray-100 dark:border-gray-800">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.checkout_keys.title') }}</h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Shopping Details -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] p-8 lg:p-12 border border-gray-100 dark:border-gray-700">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-8">{{ __('messages.checkout_keys.summary') }}</h2>
                        <div class="divide-y divide-gray-50 dark:divide-gray-700">
                            @foreach($cart as $id => $item)
                                <div class="py-10 flex items-center justify-between group">
                                    <div class="flex items-center gap-8">
                                        <div class="w-24 h-24 rounded-[1.5rem] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-inner flex-shrink-0">
                                            <img src="{{ $item['image'] }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-black text-xl text-gray-900 dark:text-white uppercase tracking-tight leading-tight">{{ $item['name'] }}</div>
                                            <div class="text-[10px] text-gray-400 font-black uppercase tracking-widest mt-2">{{ __('messages.cart_keys.quantity') }}: {{ $item['quantity'] }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-black text-2xl text-primary leading-none tracking-tighter">{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }}</div>
                                        <div class="text-[10px] font-black text-gray-400 mt-2 uppercase tracking-widest">PLN</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Method Selection -->
                    <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] p-8 lg:p-12 border border-gray-100 dark:border-gray-700 mt-8" x-data="{ shipping: 'standard', locker: null }">
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-8">{{ __('messages.shipping.title') }}</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                            <!-- Standard Shipping -->
                            <label class="relative flex flex-col p-6 rounded-3xl border-2 cursor-pointer transition-all hover:bg-gray-50 dark:hover:bg-gray-900/50" :class="shipping === 'standard' ? 'border-primary bg-primary/5' : 'border-gray-100 dark:border-gray-700'">
                                <input type="radio" name="shipping_method" value="standard" class="hidden" x-model="shipping">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-xl flex items-center justify-center text-gray-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    </div>
                                    <span class="text-xs font-black text-emerald-500 uppercase tracking-widest">{{ __('messages.shipping.free') }}</span>
                                </div>
                                <span class="block font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ __('messages.shipping.standard') }}</span>
                                <span class="block text-xs text-gray-400 font-bold mt-1 uppercase tracking-widest">{{ __('messages.shipping.standard_days') }}</span>
                            </label>

                            <!-- InPost Shipping -->
                            <label class="relative flex flex-col p-6 rounded-3xl border-2 cursor-pointer transition-all hover:bg-gray-50 dark:hover:bg-gray-900/50" :class="shipping === 'inpost' ? 'border-primary bg-primary/5' : 'border-gray-100 dark:border-gray-700'">
                                <input type="radio" name="shipping_method" value="inpost" class="hidden" x-model="shipping">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-10 h-10 bg-yellow-400 rounded-xl flex items-center justify-center text-black">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4 14h16v2H4v-2zm0-4h16v2H4v-2zm0-4h16v2H4V6z"/></svg>
                                    </div>
                                    <span class="text-xs font-black text-emerald-500 uppercase tracking-widest">{{ __('messages.shipping.free') }}</span>
                                </div>
                                <span class="block font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ __('messages.shipping.inpost') }}</span>
                                <span class="block text-xs text-gray-400 font-bold mt-1 uppercase tracking-widest">{{ __('messages.shipping.inpost_days') }}</span>
                            </label>
                        </div>

                        <!-- InPost Locker Selection UI -->
                        <div x-show="shipping === 'inpost'" x-transition class="bg-gray-50 dark:bg-gray-950 p-6 rounded-3xl border border-dashed border-gray-200 dark:border-gray-800 text-center">
                            <div x-show="!locker">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-6 px-4">{{ __('messages.shipping.select_locker') }}</p>
                                <button type="button" 
                                    onclick="openInPostModal()"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-black px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest shadow-xl shadow-yellow-400/20 transition-all">
                                    {{ __('messages.shipping.open_map') }}
                                </button>
                            </div>
                            <div x-show="locker" class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-emerald-500 text-white rounded-full flex items-center justify-center mb-4 shadow-xl shadow-emerald-500/20">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <h4 class="font-black text-gray-900 dark:text-white uppercase tracking-tight" x-text="locker ? '{{ __('messages.shipping.selected') }}: ' + locker.name : ''"></h4>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1" x-text="locker ? locker.address.line1 : ''"></p>
                                <button type="button" onclick="openInPostModal()" class="mt-6 text-xs font-black text-primary uppercase border-b-2 border-primary/20 hover:border-primary transition-all pb-1">{{ __('messages.shipping.change_locker') }}</button>
                            </div>
                            <input type="hidden" name="inpost_locker_id" :value="locker ? locker.name : ''">
                        </div>
                    </div>

                    <!-- Eco-Friendly badge -->
                    <div class="bg-emerald-50 dark:bg-emerald-950/20 rounded-[2rem] p-10 border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-8 mt-8">
                        <div class="bg-emerald-500 text-white p-5 rounded-[1.5rem] shadow-xl shadow-emerald-500/20">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <p class="text-gray-900 dark:text-gray-100 font-bold text-lg leading-relaxed">
                            {{ __('messages.sustainable_vending') }} <br>
                            <span class="text-xs font-black uppercase tracking-widest text-emerald-600">{{ __('messages.checkout_keys.eco_shipping') }}</span>
                        </p>
                    </div>

                    <script>
                        function openInPostModal() {
                            const config = {
                                token: '{{ env('VITE_INPOST_GEOWIDGET_TOKEN') }}',
                                onpoint: function(point) {
                                    console.log('Point selected:', point);
                                    // Update Alpine.js state
                                    const alpineEl = document.querySelector('[x-data]');
                                    if (window.Alpine && alpineEl) {
                                        window.Alpine.$data(alpineEl).locker = point;
                                    }
                                }
                            };
                            window.InPost.geowidget.init(config);
                            window.InPost.geowidget.open();
                        }
                    </script>
                </div>

                <!-- Summary Panel -->
                <div class="space-y-8">
                    <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] rounded-[2.5rem] p-8 lg:p-10 border-2 border-primary/20 sticky top-24 overflow-hidden">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-10 pb-6 border-b border-gray-50 dark:border-gray-700 uppercase tracking-tight">{{ __('messages.checkout_keys.summary') }}</h3>
                        
                        <div class="space-y-8 mb-12">
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">{{ __('messages.checkout_keys.subtotal') }}</span>
                                <span class="text-gray-900 dark:text-white font-black text-lg">{{ number_format($total, 0, '.', ' ') }} <span class="text-xs">PLN</span></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">{{ __('messages.checkout_keys.delivery') }}</span>
                                <span class="text-emerald-500 font-black text-sm uppercase tracking-[0.2em]">{{ __('messages.checkout_keys.eco_free') }}</span>
                            </div>
                            <div class="pt-8 border-t border-gray-50 dark:border-gray-700 flex justify-between items-end">
                                <span class="text-gray-900 dark:text-white font-black text-xl uppercase tracking-tighter">{{ __('messages.checkout_keys.total') }}</span>
                                <div class="text-right">
                                    <span class="text-5xl font-black text-primary leading-none tracking-tighter">{{ number_format($total, 0, '.', ' ') }}</span>
                                    <span class="text-sm font-black text-primary uppercase ml-2 tracking-widest">PLN</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('stripe.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="group w-full bg-primary hover:bg-primary-dark text-white py-6 rounded-[2rem] font-black text-2xl shadow-2xl shadow-primary/30 transform active:scale-95 transition-all flex items-center justify-center gap-4">
                                {{ __('messages.checkout_keys.pay') }}
                                <svg class="w-7 h-7 transform group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </form>
                        
                        <div class="mt-12 flex items-center justify-center gap-6 grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-700">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" class="h-4">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-6">
                            <img src="https://logotypy.pl/wp-content/uploads/2016/10/blik.png" class="h-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
