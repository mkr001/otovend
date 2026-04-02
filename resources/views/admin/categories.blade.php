<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-10">
                <div class="bg-primary p-3 rounded-2xl text-white shadow-xl shadow-primary/20">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">Manage Categories</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Add New Category Form -->
                <div class="md:col-span-1">
                    <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] p-8 border border-gray-100 dark:border-gray-700">
                        <h2 class="text-xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-8">Add Category</h2>
                        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Slug (URL)</label>
                                <input type="text" name="slug" required placeholder="e.g. automat-vendingowy" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-3 px-4 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Name (Polish)</label>
                                <input type="text" name="name_pl" required placeholder="e.g. Automaty vendingowe" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-3 px-4 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Name (English)</label>
                                <input type="text" name="name_en" required placeholder="e.g. Vending Machines" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-3 px-4 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                            </div>
                            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white rounded-2xl font-black text-sm uppercase tracking-widest transition-all transform active:scale-95 shadow-xl shadow-primary/20 py-4 mt-4">
                                Save Category
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Category List -->
                <div class="md:col-span-2">
                    <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50/50 dark:bg-gray-900/50 border-b border-gray-100 dark:border-gray-700">
                                <tr>
                                    <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Slug</th>
                                    <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Name (PL)</th>
                                    <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Name (EN)</th>
                                    <th class="py-6 px-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                                @forelse ($categories as $cat)
                                    <tr class="group hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                        <td class="py-4 px-8 font-bold text-gray-900 dark:text-white">{{ $cat->slug }}</td>
                                        <td class="py-4 px-8 text-gray-500">{{ $cat->name_pl }}</td>
                                        <td class="py-4 px-8 text-gray-500">{{ $cat->name_en }}</td>
                                        <td class="py-4 px-8 text-right">
                                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-black text-red-500 hover:text-red-700 uppercase tracking-widest px-4 py-2 bg-red-50 dark:bg-red-900/20 rounded-xl transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-gray-400 font-bold uppercase tracking-widest text-[10px]">No categories found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
