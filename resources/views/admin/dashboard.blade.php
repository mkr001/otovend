<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-12">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ __('messages.admin_dashboard') }}</h1>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="bg-white dark:bg-gray-800 p-8 shadow-sm rounded-3xl border border-gray-100 dark:border-gray-700">
                    <div class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('messages.admin_keys.user') }}</div>
                    <div class="text-4xl font-black text-gray-900 dark:text-white">{{ $totalUsers }}</div>
                    <div class="mt-4 text-xs font-bold text-green-600">+12% vs last month</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 shadow-sm rounded-3xl border border-gray-100 dark:border-gray-700">
                    <div class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('messages.admin_keys.product') }}</div>
                    <div class="text-4xl font-black text-gray-900 dark:text-white">{{ $totalProducts }}</div>
                    <div class="mt-4 text-xs font-bold text-primary">Aktywny katalog</div>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 shadow-sm rounded-3xl border border-gray-100 dark:border-gray-700">
                    <div class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('messages.my_orders') }}</div>
                    <div class="text-4xl font-black text-gray-900 dark:text-white">{{ $totalOrders }}</div>
                    <div class="mt-4 text-xs font-bold text-blue-600">Przygotowane do wysyłki</div>
                </div>
                <div class="bg-primary p-8 shadow-2xl rounded-3xl text-white">
                    <div class="text-xs font-black text-white/70 uppercase tracking-widest mb-2">Łączny przychód</div>
                    <div class="text-4xl font-black">{{ number_format($totalRevenue, 0, '.', ' ') }} <span class="text-sm">PLN</span></div>
                    <div class="mt-4 text-xs font-bold text-white/80 italic">OTOMOTO Stats Ready</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Recent Orders Table -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-8 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
                            <h2 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white">{{ __('messages.admin_keys.actions') ?? 'Recent Orders' }}</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th class="px-8 py-4 text-left text-xs font-black text-gray-400 uppercase tracking-widest">{{ __('messages.admin_keys.user') }}</th>
                                        <th class="px-8 py-4 text-left text-xs font-black text-gray-400 uppercase tracking-widest">{{ __('messages.checkout_keys.total') }}</th>
                                        <th class="px-8 py-4 text-left text-xs font-black text-gray-400 uppercase tracking-widest">{{ __('messages.vendor_dashboard_keys.status') }}</th>
                                        <th class="px-8 py-4 text-right text-xs font-black text-gray-400 uppercase tracking-widest">{{ __('messages.vendor_sales.date') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td class="px-8 py-5">
                                                <div class="font-bold text-gray-900 dark:text-white">{{ $order->user->name }}</div>
                                                <div class="text-xs text-gray-400">{{ $order->user->email }}</div>
                                            </td>
                                            <td class="px-8 py-5 font-black text-primary">{{ number_format($order->total_price, 0, '.', ' ') }} PLN</td>
                                            <td class="px-8 py-5">
                                                <span class="px-3 py-1 bg-primary/10 text-primary rounded-full text-[10px] font-black uppercase tracking-widest">{{ $order->status }}</span>
                                            </td>
                                            <td class="px-8 py-5 text-right text-sm text-gray-500 font-medium">{{ $order->created_at->format('d.m.Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Admin Quick Actions -->
                <div class="space-y-8">
                    <div class="bg-white dark:bg-gray-800 p-8 shadow-sm rounded-3xl border border-gray-100 dark:border-gray-700">
                        <h2 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white mb-8">{{ __('messages.trust_section.cta') }}</h2>
                        <div class="space-y-4">
                            <a href="{{ route('admin.users') }}" class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl hover:bg-primary/5 group transition border border-transparent hover:border-primary/10">
                                <span class="font-bold text-gray-700 dark:text-gray-300 group-hover:text-primary transition">{{ __('messages.admin_keys.users') }}</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-primary transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a href="{{ route('admin.products') }}" class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl hover:bg-primary/5 group transition border border-transparent hover:border-primary/10">
                                <span class="font-bold text-gray-700 dark:text-gray-300 group-hover:text-primary transition">{{ __('messages.admin_keys.products') }}</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-primary transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a href="{{ route('admin.roles') }}" class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl hover:bg-primary/5 group transition border border-transparent hover:border-primary/10">
                                <span class="font-bold text-gray-700 dark:text-gray-300 group-hover:text-primary transition">Role i Uprawnienia</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-primary transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </a>
                            <button class="w-full mt-6 py-4 bg-gray-900 text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-black transition-all">Wygeneruj Raport PDF</button>
                        </div>
                    </div>

                    <!-- Small Analytics placeholder -->
                    <div class="bg-white dark:bg-gray-800 p-8 shadow-sm rounded-3xl border border-gray-100 dark:border-gray-700">
                        <h2 class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-6 text-center">Trend sprzedaży (Ostatnie 7 dni)</h2>
                        <div class="flex items-end justify-center gap-2 h-32 px-4">
                            <div class="w-full bg-primary/20 rounded-t-lg transition-all hover:bg-primary h-2/4"></div>
                            <div class="w-full bg-primary/20 rounded-t-lg transition-all hover:bg-primary h-3/4"></div>
                            <div class="w-full bg-primary/20 rounded-t-lg transition-all hover:bg-primary h-2/4"></div>
                            <div class="w-full bg-primary/20 rounded-t-lg transition-all hover:bg-primary h-4/4"></div>
                            <div class="w-full bg-primary/20 rounded-t-lg transition-all hover:bg-primary h-1/4"></div>
                            <div class="w-full bg-primary/20 rounded-t-lg transition-all hover:bg-primary h-3/4"></div>
                            <div class="w-full bg-primary/20 rounded-t-lg transition-all hover:bg-primary h-5/4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
