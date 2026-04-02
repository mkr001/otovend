<x-app-layout>
    <div class="py-16 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-10 pb-6 border-b border-gray-100 dark:border-gray-800">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ __('messages.orders.title') }}</h1>
            </div>

            <div class="space-y-8">
                @forelse($orders as $order)
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-700">
                        <div class="p-8 bg-gray-50 dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700 flex flex-wrap justify-between items-center gap-6">
                            <div class="flex flex-wrap gap-10">
                                <div>
                                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.orders.order_date') }}</h3>
                                    <p class="text-sm dark:text-white font-black uppercase tracking-tight">{{ $order->created_at->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.orders.order_number') }}</h3>
                                    <p class="text-sm dark:text-white font-black uppercase tracking-tight">#{{ $order->id }}</p>
                                </div>
                                <div>
                                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.orders.total') }}</h3>
                                    <p class="text-sm text-primary font-black uppercase tracking-tight">{{ number_format($order->total_price, 0, '.', ' ') }} PLN</p>
                                </div>
                                <div>
                                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">{{ __('messages.orders.documents') }}</h3>
                                    <a href="{{ route('invoices.download', $order) }}" class="text-xs font-bold text-gray-600 dark:text-gray-300 hover:text-primary flex items-center gap-1 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        {{ __('messages.orders.invoice_pdf') }}
                                    </a>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="px-5 py-2 {{ $order->status == 'delivered' ? 'bg-green-500' : ($order->status == 'shipped' ? 'bg-blue-500' : 'bg-primary') }} text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-primary/20">
                                        @if($order->status == 'shipped') {{ __('messages.orders.status_shipped') }}
                                        @elseif($order->status == 'delivered') {{ __('messages.orders.status_delivered') }}
                                        @else {{ __('messages.orders.status_pending') }}
                                        @endif
                                    </span>
                                    <span class="px-5 py-2 {{ $order->payment_status == 'paid' ? 'bg-emerald-500' : 'bg-gray-400' }} text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/10">
                                        {{ $order->payment_status == 'paid' ? __('messages.orders.paid') : __('messages.orders.unpaid') }}
                                    </span>
                                </div>
                                @if($order->tracking_number)
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-white dark:bg-gray-800 px-3 py-1.5 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-2">
                                    <svg class="w-3 h-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    {{ __('messages.orders.tracking') }}: <span class="text-gray-900 dark:text-white">{{ $order->tracking_number }}</span>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="p-8 divide-y divide-gray-50 dark:divide-gray-700">
                            @foreach($order->items as $item)
                                <div class="py-8 flex items-center justify-between group">
                                    <div class="flex items-center gap-8">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden border border-gray-100 shadow-inner flex-shrink-0">
                                            <img src="{{ $item->product->image ?? 'https://via.placeholder.com/100' }}" class="w-full h-full object-cover" loading="lazy">
                                        </div>
                                        <div>
                                            <div class="font-black text-lg text-gray-900 dark:text-white uppercase tracking-tight hover:text-primary transition">{{ $item->product->name }}</div>
                                            <div class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ __('messages.orders.quantity') }}: {{ $item->quantity }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right font-black text-xl text-gray-900 dark:text-white">{{ number_format($item->price * $item->quantity, 0, '.', ' ') }} <span class="text-xs">PLN</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="py-32 bg-white dark:bg-gray-800 shadow-2xl rounded-3xl text-center border-2 border-dashed border-gray-100 dark:border-gray-800">
                         <svg class="w-20 h-20 text-gray-100 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-2">{{ __('messages.orders.empty_title') }}</h2>
                        <p class="text-gray-400 font-bold uppercase text-xs tracking-widest">{{ __('messages.orders.empty_sub') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
