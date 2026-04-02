<x-app-layout>
    <div class="py-32 bg-white dark:bg-gray-950 flex flex-col items-center justify-center min-h-[70vh] text-center font-sans">
        <div class="relative mb-10">
            <div class="absolute inset-0 bg-primary/20 blur-3xl rounded-full scale-150"></div>
            <div class="w-32 h-32 bg-gray-50 dark:bg-gray-900 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-xl flex items-center justify-center relative z-10 transform -rotate-12 group-hover:rotate-0 transition-transform duration-500">
                <svg class="w-16 h-16 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
        </div>

        <h1 class="text-7xl font-black text-gray-900 dark:text-white mb-4 tracking-tighter">403</h1>
        <h2 class="text-3xl font-black text-gray-800 dark:text-gray-100 mb-4 px-4">{{ __('Odmowa dostępu / Unauthorized') }}</h2>
        <p class="text-gray-500 dark:text-gray-400 font-medium max-w-md mx-auto mb-10 px-4 leading-relaxed">
            Niestety, nie masz odpowiednich uprawnień, aby przeglądać tę stronę. Jeśli uważasz, że to błąd, skontaktuj się z autorem platformy.
        </p>

        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-xl font-black text-sm uppercase tracking-widest shadow-lg shadow-primary/20 transition-all transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Wróć na Stronę Główną
        </a>
    </div>
</x-app-layout>
