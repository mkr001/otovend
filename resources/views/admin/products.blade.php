<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-6">
                <div class="flex items-center gap-4">
                    <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 11m8 4V21M4 11v10l8 4"/></svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.admin_keys.products_title') }}</h1>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-1">{{ count($products) }} {{ __('messages.admin_keys.products_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[3.5rem] overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.product') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.vendor') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.category') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.price') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">{{ __('messages.admin_keys.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                            @foreach($products as $product)
                                <tr class="group hover:bg-gray-50/30 dark:hover:bg-gray-900/30 transition-all duration-300">
                                    <td class="px-10 py-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gray-100 rounded-2xl overflow-hidden shadow-inner flex-shrink-0">
                                                <img src="{{ $product->image ?? 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <div class="font-black text-gray-900 dark:text-white uppercase tracking-tight text-sm">{{ $product->name }}</div>
                                                <div class="text-[9px] text-gray-400 font-bold tracking-widest uppercase mt-1 italic italic">{{ __('messages.condition') }}: {{ $product->condition }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-10 py-8">
                                        <div class="font-bold text-gray-600 dark:text-gray-400 text-sm italic underline">
                                            {{ $product->vendor->shop_name ?? 'Brak nazwy' }}
                                        </div>
                                    </td>
                                    <td class="px-10 py-8">
                                        <span class="inline-flex px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            {{ __('messages.category_map.' . $product->category) ?? $product->category }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8">
                                        <div class="font-black text-primary text-xl leading-none tracking-tighter">{{ number_format($product->price, 0, '.', ' ') }}</div>
                                        <div class="text-[9px] font-black text-gray-300 uppercase tracking-widest mt-1">PLN</div>
                                    </td>
                                    <td class="px-10 py-8 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('products.show', $product->id) }}" target="_blank" class="p-3 text-gray-300 hover:text-blue-500 hover:bg-blue-50 rounded-2xl transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <button class="p-3 text-gray-300 hover:text-red-600 hover:bg-red-50 rounded-2xl transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
