<x-app-layout>
    <div class="py-16 bg-gray-50 dark:bg-gray-950 min-h-screen font-sans">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2.25 2.25c-.63.63-.18 1.35.44 1.35h12m-12 0a1 1 0 100 2 1 1 0 000-2zm10 0a1 1 0 100 2 1 1 0 000-2z"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.cart_keys.title') }}</h1>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] p-8 lg:p-12 border border-gray-100 dark:border-gray-700">
                @if(count($cart) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="border-b border-gray-50 dark:border-gray-700">
                                <tr>
                                    <th class="pb-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.cart_keys.product') }}</th>
                                    <th class="pb-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-center">{{ __('messages.cart_keys.quantity') }}</th>
                                    <th class="pb-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">{{ __('messages.cart_keys.price') }}</th>
                                    <th class="pb-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">{{ __('messages.cart_keys.remove') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                @foreach($cart as $id => $item)
                                    <tr class="group">
                                        <td class="py-10">
                                            <div class="flex items-center gap-8">
                                                <div class="w-24 h-24 rounded-[1.5rem] overflow-hidden shadow-inner border border-gray-100 dark:border-gray-700 flex-shrink-0">
                                                    <img src="{{ $item['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                                </div>
                                                <div>
                                                    <div class="font-black text-xl text-gray-900 dark:text-white mb-2 uppercase tracking-tight leading-tight">{{ $item['name'] }}</div>
                                                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                        {{ __('messages.verified') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-10 text-center">
                                            <span class="inline-flex bg-gray-50 dark:bg-gray-900 px-5 py-2.5 rounded-2xl border border-gray-100 dark:border-gray-700 font-black text-gray-900 dark:text-white">
                                                {{ $item['quantity'] }}
                                            </span>
                                        </td>
                                        <td class="py-10 text-right">
                                            <div class="font-black text-3xl text-primary leading-none tracking-tighter">{{ number_format($item['price'] * $item['quantity'], 0, '.', ' ') }}</div>
                                            <div class="text-[10px] font-black text-gray-400 mt-2 uppercase tracking-widest">PLN</div>
                                        </td>
                                        <td class="py-10 text-right">
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-4 text-gray-300 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-950/20 rounded-2xl transition-all group/btn">
                                                    <svg class="w-6 h-6 transform group-hover/btn:rotate-12 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Summary -->
                    <div class="mt-20 bg-gray-900 dark:bg-gray-950 p-10 lg:p-16 rounded-[3rem] shadow-2xl shadow-black/10 flex flex-col md:flex-row justify-between items-center gap-10">
                        <div>
                            <div class="text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">{{ __('messages.cart_keys.total') }}</div>
                            <div class="flex items-baseline gap-3">
                                <span class="text-6xl font-black text-white tracking-tighter">{{ number_format($total, 0, '.', ' ') }}</span>
                                <span class="text-xl font-black text-primary uppercase tracking-widest">PLN</span>
                            </div>
                        </div>
                        <div class="w-full md:w-auto">
                            <a href="{{ route('checkout') }}" class="group w-full md:w-auto px-12 py-6 bg-primary hover:bg-primary-dark text-white rounded-[2rem] font-black text-xl shadow-2xl shadow-primary/30 transition-all transform active:scale-95 flex items-center justify-center gap-4">
                                {{ __('messages.cart_keys.checkout') }}
                                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="py-32 text-center">
                        <div class="w-32 h-32 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-10 text-gray-200">
                             <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2.25 2.25c-.63.63-.18 1.35.44 1.35h12m-12 0a1 1 0 100 2 1 1 0 000-2zm10 0a1 1 0 100 2 1 1 0 000-2z"/></svg>
                        </div>
                        <h2 class="text-4xl font-black text-gray-900 dark:text-white uppercase mb-4 tracking-tight">{{ __('messages.cart_keys.empty') }}</h2>
                        <p class="text-gray-400 mb-12 text-lg font-medium">{{ __('messages.cart_keys.empty_sub') }}</p>
                        <a href="{{ route('home') }}" class="inline-flex px-12 py-5 bg-primary text-white font-black rounded-[2rem] shadow-2xl shadow-primary/30 hover:bg-primary-dark transition-all uppercase tracking-tight">
                            {{ __('messages.cart_keys.back') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
