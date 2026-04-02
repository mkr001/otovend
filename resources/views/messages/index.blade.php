<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('Wiadomości') }}</h1>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="divide-y divide-gray-50 dark:divide-gray-700">
                    @forelse($contacts as $contact)
                        <a href="{{ route('messages.show', $contact) }}" class="flex items-center justify-between p-8 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-all group">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center border-2 border-white dark:border-gray-700 shadow-md">
                                    <span class="text-xl font-black text-gray-500 dark:text-gray-300">{{ substr($contact->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-gray-900 dark:text-white tracking-tight group-hover:text-primary transition-colors">{{ $contact->name }}</h3>
                                    <p class="text-sm font-bold text-gray-400 mt-1 uppercase tracking-widest">
                                        @if($contact->role === 'vendor' && $contact->vendor)
                                            {{ $contact->vendor->shop_name }}
                                        @else
                                            Użytkownik
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl text-gray-400 group-hover:bg-primary group-hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                    @empty
                        <div class="p-20 text-center">
                            <div class="w-24 h-24 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-8 text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-2">Brak wiadomości</h3>
                            <p class="text-gray-400 font-bold tracking-widest text-sm uppercase">Twoja skrzynka odbiorcza jest pusta.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
