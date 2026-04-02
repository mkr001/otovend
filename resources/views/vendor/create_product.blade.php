<x-app-layout>
    <div class="py-16 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-12">
                <a href="{{ route('vendor.dashboard') }}" class="p-3 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:text-primary transition group">
                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.create_product.title') }}</h1>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-1 italic">{{ __('messages.create_product.subtitle') }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[3rem] p-8 md:p-16 border border-gray-100 dark:border-gray-700">
                <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf

                    <!-- Basic Info Group -->
                    <div class="space-y-8">
                        <h2 class="text-xs font-black text-primary uppercase tracking-[0.3em] pb-2 border-b border-gray-50 dark:border-gray-700">{{ __('messages.create_product.basic_info') }}</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.model') }}</label>
                                <input type="text" name="name" required placeholder="Np. Necta Opera Z3000" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold text-lg transition shadow-inner">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.category') }}</label>
                                <select name="category" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.price') }}</label>
                                <input type="number" name="price" required placeholder="0.00" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold text-lg transition shadow-inner">
                            </div>
                        </div>
                    </div>

                    <!-- Technical Specs Group -->
                    <div class="space-y-8">
                        <h2 class="text-xs font-black text-primary uppercase tracking-[0.3em] pb-2 border-b border-gray-50 dark:border-gray-700">{{ __('messages.create_product.tech_specs') }}</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.year') }}</label>
                                <input type="number" name="year" placeholder="2024" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.location') }}</label>
                                <input type="text" name="location" placeholder="Np. Warszawa" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                            </div>

                            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.condition') }}</label>
                                <div class="flex bg-gray-100/50 dark:bg-gray-900 p-1.5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-inner">
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="condition" value="new" class="sr-only peer" checked>
                                        <div class="py-3 text-center rounded-xl font-black text-[10px] uppercase tracking-widest transition-all peer-checked:bg-primary peer-checked:text-white peer-checked:shadow-md text-gray-500 hover:text-gray-900 dark:hover:text-white">{{ __('messages.create_product.new') }}</div>
                                    </label>
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="condition" value="used" class="sr-only peer">
                                        <div class="py-3 text-center rounded-xl font-black text-[10px] uppercase tracking-widest transition-all peer-checked:bg-primary peer-checked:text-white peer-checked:shadow-md text-gray-500 hover:text-gray-900 dark:hover:text-white">{{ __('messages.create_product.used') }}</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description & Media -->
                    <div class="space-y-8">
                        <h2 class="text-xs font-black text-primary uppercase tracking-[0.3em] pb-2 border-b border-gray-50 dark:border-gray-700">{{ __('messages.create_product.desc_media') }}</h2>
                        
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.desc') }}</label>
                            <textarea name="description" rows="6" placeholder="Opisz stan techniczny, historię serwisu i kluczowe funkcje..." class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-[2rem] py-6 px-8 focus:ring-primary focus:border-primary font-medium text-lg transition shadow-inner leading-relaxed"></textarea>
                        </div>

                        <!-- Multi Photo Upload Area -->
                        <div id="photo-drop-zone" class="p-10 border-4 border-dashed border-gray-200 dark:border-gray-700 rounded-[3rem] text-center bg-gray-50 dark:bg-gray-900/50 group hover:border-primary/40 transition-all cursor-pointer relative" onclick="document.getElementById('photo-input').click()">
                            <input type="file" id="photo-input" name="images[]" accept="image/*" multiple class="hidden" onchange="previewImages(this)">
                            <div id="upload-placeholder">
                                <div class="w-20 h-20 bg-white dark:bg-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-4 text-primary shadow-lg shadow-primary/10 group-hover:scale-110 transition-transform">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <p class="text-gray-900 dark:text-white font-black uppercase text-sm tracking-widest mb-2">Przeciągnij zdjęcia lub kliknij</p>
                                <p class="text-gray-400 text-xs">Maks. 10 zdjęć · JPG, PNG, WEBP · Maks. 2MB każde</p>
                                <p class="mt-4 text-primary font-black text-[10px] uppercase tracking-[0.2em]">Pierwsze zdjęcie będzie okładką ★</p>
                            </div>
                            <div id="image-preview-grid" class="hidden">
                                <div id="thumbnails" class="flex flex-wrap gap-3 justify-center mb-4"></div>
                                <p class="text-primary font-black uppercase text-[10px] tracking-widest cursor-pointer hover:underline">+ Dodaj więcej zdjęć ↻</p>
                            </div>
                        </div>

                        @error('images.*')
                            <p class="text-red-500 text-sm font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="pt-10">
                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-6 rounded-[2rem] font-black text-2xl shadow-2xl shadow-primary/40 transform active:scale-95 transition-all uppercase tracking-tight flex items-center justify-center gap-4 group">
                            {{ __('messages.create_product.publish') }}
                            <svg class="w-7 h-7 transform group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                        <p class="mt-6 text-center text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]">{{ __('messages.create_product.publish_sub') }}</p>
                    </div>
                </form>

                <script>
                    function previewImages(input) {
                        const placeholder = document.getElementById('upload-placeholder');
                        const previewGrid = document.getElementById('image-preview-grid');
                        const thumbnails = document.getElementById('thumbnails');
                        const dropZone = document.getElementById('photo-drop-zone');

                        if (input.files && input.files.length > 0) {
                            thumbnails.innerHTML = '';
                            Array.from(input.files).forEach((file, index) => {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const wrapper = document.createElement('div');
                                    wrapper.className = 'relative group/thumb';

                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.className = 'w-24 h-24 object-cover rounded-2xl shadow-md border-2 ' + (index === 0 ? 'border-primary ring-2 ring-primary/50' : 'border-gray-200 dark:border-gray-700');
                                    img.title = index === 0 ? 'Okładka (Primary)' : file.name;

                                    if (index === 0) {
                                        const badge = document.createElement('div');
                                        badge.className = 'absolute -top-2 -right-2 bg-primary text-white text-[8px] font-black px-2 py-0.5 rounded-full shadow-md uppercase tracking-wider';
                                        badge.textContent = '★ Okładka';
                                        wrapper.appendChild(badge);
                                    }

                                    wrapper.appendChild(img);
                                    thumbnails.appendChild(wrapper);
                                };
                                reader.readAsDataURL(file);
                            });

                            placeholder.classList.add('hidden');
                            previewGrid.classList.remove('hidden');
                            dropZone.classList.add('border-primary/30', 'bg-primary/5');
                        }
                    }

                    // Drag and drop support
                    const dropZone = document.getElementById('photo-drop-zone');
                    ['dragenter', 'dragover'].forEach(evt => {
                        dropZone.addEventListener(evt, (e) => {
                            e.preventDefault();
                            dropZone.classList.add('border-primary', 'bg-primary/5');
                        });
                    });
                    ['dragleave', 'drop'].forEach(evt => {
                        dropZone.addEventListener(evt, (e) => {
                            e.preventDefault();
                            dropZone.classList.remove('border-primary', 'bg-primary/5');
                        });
                    });
                    dropZone.addEventListener('drop', (e) => {
                        e.preventDefault();
                        const input = document.getElementById('photo-input');
                        input.files = e.dataTransfer.files;
                        previewImages(input);
                    });
                </script>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
