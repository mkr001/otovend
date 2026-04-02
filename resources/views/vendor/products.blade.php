<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div class="flex items-center gap-3">
                    <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.vendor_dashboard_keys.my_listings') }}</h1>
                </div>
                <a href="{{ route('vendor.products.create') }}" class="px-8 py-4 bg-primary hover:bg-primary-dark text-white rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-xl shadow-primary/20">
                    + {{ __('messages.add_listing') }}
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] border border-gray-100 dark:border-gray-700 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                        <tr>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.product') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.create_product.category') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.price') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.vendor_dashboard_keys.status') }}</th>
                            <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">{{ __('messages.admin_keys.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                        @forelse($products as $product)
                            <tr class="group hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                <td class="py-6 px-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-inner border border-gray-100 dark:border-gray-700 flex-shrink-0">
                                            <img src="{{ $product->image ?? 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $product->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ $product->year ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6 px-8">
                                    <span class="px-4 py-1.5 bg-gray-100 dark:bg-gray-900 text-gray-500 dark:text-gray-400 rounded-full text-[10px] font-black uppercase tracking-widest border border-gray-200 dark:border-gray-700">
                                        {{ $product->category }}
                                    </span>
                                </td>
                                <td class="py-6 px-8">
                                    <div class="font-black text-primary text-xl tracking-tighter">{{ number_format($product->price, 0, '.', ' ') }} <span class="text-[10px]">PLN</span></div>
                                </td>
                                <td class="py-6 px-8">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100 dark:border-emerald-900/50">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                        {{ __('messages.vendor_dashboard_keys.active') }}
                                    </span>
                                </td>
                                <td class="py-6 px-8 text-right space-x-2">
                                    <a href="{{ route('vendor.products.edit', $product) }}" class="inline-flex px-4 py-2 bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary hover:text-white transition-all">
                                        {{ __('messages.vendor_dashboard_keys.edit') }}
                                    </a>
                                    <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-50 dark:bg-red-950/20 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all" onclick="return confirm('{{ __('messages.vendor_dashboard_keys.delete') }} - {{ $product->name }}?')">
                                            {{ __('messages.vendor_dashboard_keys.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <p class="text-gray-400 font-black uppercase tracking-widest text-xs">{{ __('messages.empty_listings') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
