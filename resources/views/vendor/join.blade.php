<x-app-layout>
    <div class="py-24 bg-white dark:bg-gray-950 overflow-hidden relative font-sans">
        <!-- Abstract Decoration -->
        <div class="absolute top-0 right-0 w-[50rem] h-[50rem] bg-primary/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center text-center md:text-left">
                <!-- Left: Content -->
                <div class="space-y-10">
                    <div class="inline-flex items-center gap-2 px-5 py-2 bg-primary/10 text-primary rounded-full text-[10px] font-black uppercase tracking-[0.2em] border border-primary/20">
                        {{ __('messages.vendor_join.badge') }}
                    </div>
                    <h1 class="text-6xl md:text-8xl font-black text-gray-900 dark:text-white tracking-tighter font-display leading-[0.9]">
                        {{ __('messages.vendor_join.title') }}
                    </h1>
                    <p class="text-xl text-gray-500 font-medium leading-relaxed max-w-xl mx-auto md:mx-0">
                        {{ __('messages.vendor_join.subtitle') }}
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 pt-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-center text-primary shadow-sm border border-gray-100 dark:border-gray-800 flex-shrink-0 mx-auto md:mx-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            </div>
                            <div class="text-left">
                                <h3 class="font-black text-gray-900 dark:text-white uppercase text-xs tracking-widest mb-1">{{ __('messages.vendor_join.reach') }}</h3>
                                <p class="text-sm text-gray-400">{{ __('messages.vendor_join.reach_sub') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-50 dark:bg-gray-900 rounded-2xl flex items-center justify-center text-primary shadow-sm border border-gray-100 dark:border-gray-800 flex-shrink-0 mx-auto md:mx-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div class="text-left">
                                <h3 class="font-black text-gray-900 dark:text-white uppercase text-xs tracking-widest mb-1">{{ __('messages.vendor_join.payouts') }}</h3>
                                <p class="text-sm text-gray-400">{{ __('messages.vendor_join.payouts_sub') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Action Card -->
                <div class="relative">
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl opacity-50"></div>
                    <div class="bg-gray-900 dark:bg-gray-900/50 p-12 md:p-16 rounded-[4rem] shadow-[0_64px_128px_-24px_rgba(128,0,0,0.3)] border border-white/5 relative z-10 text-center">
                        <div class="space-y-10">
                            <div class="w-24 h-24 bg-primary text-white rounded-[2rem] flex items-center justify-center mx-auto shadow-2xl shadow-primary/40 transform -rotate-12">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-4xl font-black text-white uppercase tracking-tighter mb-4 leading-none">{{ __('messages.vendor_join.ready') }}</h2>
                                <p class="text-gray-400 font-medium">{{ __('messages.vendor_join.ready_sub') }}</p>
                            </div>
                            
                            <form action="{{ route('vendor.upgrade') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-white hover:bg-gray-100 text-gray-900 py-6 rounded-[2rem] font-black text-2xl shadow-xl transition-all transform active:scale-95 uppercase tracking-tight">
                                    {{ __('messages.vendor_join.activate') }}
                                </button>
                            </form>
                            
                            <p class="text-[10px] text-gray-500 font-black uppercase tracking-[0.3em]">{{ __('messages.vendor_join.no_fee') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
