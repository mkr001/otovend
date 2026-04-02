<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center gap-3">
                    <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight">Role i Uprawnienia</h1>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                @foreach($roles as $role)
                    <div class="bg-white dark:bg-gray-800 p-8 shadow-sm rounded-[2.5rem] border border-gray-100 dark:border-gray-700">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                            <div>
                                <h2 class="text-2xl font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $role->name }}</h2>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Liczba uprawnień: {{ $role->permissions->count() }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-4 py-2 bg-primary/10 text-primary rounded-xl text-[10px] font-black uppercase tracking-widest">GUARD: {{ $role->guard_name }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
                            @foreach($role->permissions as $permission)
                                <div class="px-3 py-2 bg-gray-50 dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-xl text-[9px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 text-center flex items-center justify-center min-h-[40px] hover:border-primary/30 transition-colors">
                                    {{ str_replace('_', ' ', $permission->name) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
