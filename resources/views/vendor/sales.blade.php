<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.vendor_dashboard_keys.sales') }}</h1>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] border border-gray-100 dark:border-gray-700 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                        <tr>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.vendor_sales.date') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.vendor_sales.product') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.vendor_sales.buyer') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.vendor_sales.update_shipping') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">{{ __('messages.vendor_sales.value') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                        @forelse($sales as $sale)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                <td class="py-6 px-8 text-gray-500 text-sm font-bold">{{ $sale->created_at->format('d.m.Y H:i') }}</td>
                                <td class="py-6 px-8 font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $sale->product->name }}</td>
                                <td class="py-6 px-8 text-gray-500 font-bold uppercase text-[10px] tracking-widest">{{ $sale->order->user->name }}</td>
                                <td class="py-6 px-8">
                                    <form action="{{ route('vendor.orders.shipping', $sale->order) }}" method="POST" class="flex flex-col gap-2">
                                        @csrf @method('PUT')
                                        <div class="flex gap-2">
                                            <select name="status" class="bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 text-xs font-bold rounded-xl py-1 px-3 focus:ring-primary h-8">
                                                <option value="pending" {{ $sale->order->status == 'pending' ? 'selected' : '' }}>{{ __('messages.orders.status_pending') }}</option>
                                                <option value="shipped" {{ $sale->order->status == 'shipped' ? 'selected' : '' }}>{{ __('messages.orders.status_shipped') }}</option>
                                                <option value="delivered" {{ $sale->order->status == 'delivered' ? 'selected' : '' }}>{{ __('messages.orders.status_delivered') }}</option>
                                            </select>
                                            <input type="text" name="tracking_number" value="{{ $sale->order->tracking_number }}" placeholder="{{ __('messages.vendor_sales.tracking_number') }}" class="bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 text-xs font-bold rounded-xl py-1 px-3 focus:ring-primary w-28 h-8">
                                            <button type="submit" class="bg-primary hover:bg-primary-dark text-white rounded-xl px-3 h-8 shadow-sm flex items-center transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="py-6 px-8 text-right flex flex-col items-end gap-2 justify-center">
                                    <div class="font-black text-primary text-xl tracking-tighter">
                                        {{ number_format($sale->quantity * $sale->price, 0, '.', ' ') }} <span class="text-[10px]">PLN</span>
                                    </div>
                                    <a href="{{ route('invoices.download', $sale->order) }}" class="text-[10px] font-bold text-gray-400 hover:text-primary uppercase tracking-widest flex items-center gap-1 transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        {{ __('messages.orders.invoice_pdf') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="w-20 h-20 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-200">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="text-gray-400 font-black uppercase tracking-widest text-xs">{{ __('messages.vendor_dashboard_keys.no_transactions') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
