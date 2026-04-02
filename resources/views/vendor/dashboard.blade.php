<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.vendor_dashboard') }}</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                <div class="bg-gradient-to-br from-primary to-primary-dark p-10 shadow-2xl rounded-[2.5rem] text-white relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="text-xs font-black uppercase tracking-[0.2em] mb-4 opacity-70 text-white/80">{{ __('messages.vendor_dashboard_keys.sales_value') }}</div>
                    <div class="text-6xl font-black mb-6 tracking-tighter">{{ number_format($totalSales, 0, '.', ' ') }} <span class="text-xl">PLN</span></div>
                    <p class="text-sm opacity-90 font-medium leading-relaxed">{{ __('messages.vendor_dashboard_keys.total_revenue') }} <span class="font-bold underline italic">{{ $vendor->shop_name }}</span></p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-10 shadow-sm rounded-[2.5rem] text-gray-900 dark:text-white border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-primary/5 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                    <div class="text-xs font-black uppercase tracking-[0.2em] mb-4 opacity-50 text-gray-400">{{ __('messages.vendor_dashboard_keys.active_listings') }}</div>
                    <div class="text-6xl font-black mb-6 tracking-tighter text-gray-900 dark:text-white">{{ $vendor->products->count() }}</div>
                    <p class="text-sm opacity-60 font-medium leading-relaxed text-gray-500">{{ __('messages.vendor_dashboard_keys.active_listings_sub') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-1 space-y-8">
                    <div class="bg-white dark:bg-gray-800 p-10 shadow-sm rounded-[2.5rem] border border-gray-100 dark:border-gray-700">
                        <h2 class="text-xl font-black uppercase tracking-tight mb-8 text-gray-900 dark:text-white">{{ __('messages.vendor_dashboard_keys.profile') }}</h2>
                        <div class="space-y-6">
                            <div>
                                <div class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">{{ __('messages.vendor_dashboard_keys.shop_name') }}</div>
                                <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $vendor->shop_name }}</div>
                            </div>
                            <div>
                                <div class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">{{ __('messages.vendor_dashboard_keys.joined_date') }}</div>
                                <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $vendor->created_at->format('M Y') }}</div>
                            </div>
                        </div>
                        <div class="mt-10 border-t border-gray-50 dark:border-gray-700 pt-8">
                             <a href="{{ route('profile.edit') }}" class="text-sm font-bold text-primary hover:underline uppercase tracking-widest">{{ __('messages.vendor_dashboard_keys.edit_profile') }}</a>
                        </div>
                    </div>

                    <a href="{{ route('vendor.products.create') }}" class="block p-8 bg-gray-900 hover:bg-black text-white rounded-[2rem] shadow-2xl shadow-black/20 transition-all transform hover:-translate-y-1 text-center font-black text-xl uppercase tracking-tight">
                        + {{ __('messages.add_listing') }}
                    </a>
                </div>

                <div class="lg:col-span-2 space-y-12">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-[2.5rem] border border-gray-100 dark:border-gray-700 overflow-hidden min-h-[400px] flex flex-col">
                        <div class="p-10 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center bg-gray-50/30 dark:bg-gray-900/10">
                            <h2 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white">Analiza Sprzedaży (30 Dni)</h2>
                            <a href="{{ route('vendor.sales') }}" class="text-xs font-bold text-primary uppercase tracking-widest hover:underline">{{ __('messages.vendor_dashboard_keys.details') }}</a>
                        </div>
                        <div class="flex-1 p-6">
                            @if(array_sum($revenues) > 0)
                                <div class="relative h-[300px] w-full">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center p-12 text-center h-full">
                                    <div class="w-20 h-20 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-6 text-gray-200">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">{{ __('messages.vendor_dashboard_keys.no_transactions') }}</p>
                                    <p class="mt-2 text-gray-400 text-sm">{{ __('messages.vendor_dashboard_keys.list_more') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-[2.5rem] border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-10 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
                            <h2 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white">{{ __('messages.vendor_dashboard_keys.my_listings') }}</h2>
                            <a href="{{ route('vendor.my-products') }}" class="text-xs font-bold text-primary uppercase tracking-widest hover:underline">{{ __('messages.vendor_dashboard_keys.manage_listings') }}</a>
                        </div>
                        <div class="divide-y divide-gray-50 dark:divide-gray-700">
                            @forelse($vendor->products->take(5) as $product)
                                <div class="px-10 py-6 flex items-center justify-between group hover:bg-gray-50 dark:hover:bg-gray-900/50 transition duration-300">
                                    <div class="flex items-center gap-6">
                                        <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-inner border border-gray-100 dark:border-gray-700">
                                            <img src="{{ $product->image ?? 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $product->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ number_format($product->price, 0, '.', ' ') }} PLN • {{ $product->category }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('vendor.products.edit', $product) }}" class="p-2.5 bg-gray-50 dark:bg-gray-900 text-gray-400 hover:text-primary rounded-xl transition shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                        <a href="{{ route('products.show', $product) }}" class="p-2.5 bg-gray-50 dark:bg-gray-900 text-gray-400 hover:text-emerald-500 rounded-xl transition shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center text-gray-400 font-bold uppercase tracking-widest text-xs">
                                    {{ __('messages.empty_listings') ?? 'Brak ogłoszeń' }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(array_sum($revenues) > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            
            // Create gradient
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(34, 197, 94, 0.4)'); // Primary color with opacity
            gradient.addColorStop(1, 'rgba(34, 197, 94, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($dates) !!},
                    datasets: [{
                        label: 'Przychód (PLN)',
                        data: {!! json_encode($revenues) !!},
                        borderColor: '#22c55e', // Primary
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#22c55e',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // Smooth curves
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111827',
                            padding: 12,
                            titleFont: { size: 10, family: "'Inter', sans-serif" },
                            bodyFont: { size: 14, weight: 'bold', family: "'Inter', sans-serif" },
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y.toLocaleString('pl-PL') + ' PLN';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { 
                                font: { size: 10, family: "'Inter', sans-serif", weight: 'bold' },
                                color: '#9ca3af',
                                maxTicksLimit: 7 
                            }
                        },
                        y: {
                            grid: { color: '#f3f4f6', drawBorder: false, borderDash: [5, 5] },
                            ticks: {
                                font: { size: 10, family: "'Inter', sans-serif", weight: 'bold' },
                                color: '#9ca3af',
                                callback: function(value) {
                                    return value > 0 ? (value / 1000) + 'k' : 0;
                                }
                            },
                            beginAtZero: true
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        });
    </script>
    @endif
</x-app-layout>
