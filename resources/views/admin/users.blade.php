<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-6">
                <div class="flex items-center gap-4">
                    <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.admin_keys.users_title') }}</h1>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-1">{{ count($users) }} {{ __('messages.admin_keys.users_subtitle') }}</p>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[3.5rem] overflow-hidden border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.id') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.user') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.role') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">{{ __('messages.admin_keys.joined') }}</th>
                                <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">{{ __('messages.admin_keys.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                            @foreach($users as $user)
                                <tr class="group hover:bg-gray-50/30 dark:hover:bg-gray-900/30 transition-all duration-300">
                                    <td class="px-10 py-8">
                                        <span class="font-bold text-gray-400 text-sm italic">#{{ $user->id }}</span>
                                    </td>
                                    <td class="px-10 py-8">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center font-black text-lg">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-black text-gray-900 dark:text-white uppercase tracking-tight">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-400 font-bold tracking-wider lowercase">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-10 py-8">
                                        <span class="inline-flex px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border
                                            {{ $user->role == 'admin' ? 'bg-purple-50 text-purple-600 border-purple-100' : 
                                               ($user->role == 'vendor' ? 'bg-primary/5 text-primary border-primary/10' : 'bg-gray-50 text-gray-500 border-gray-100') }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-10 py-8">
                                        <div class="text-sm font-bold text-gray-500 dark:text-gray-400">{{ $user->created_at->format('d.m.Y') }}</div>
                                        <div class="text-[9px] font-black text-gray-300 uppercase tracking-widest">{{ $user->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-10 py-8 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button class="p-3 text-gray-300 hover:text-primary hover:bg-primary/5 rounded-2xl transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </button>
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
