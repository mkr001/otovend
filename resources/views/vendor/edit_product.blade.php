<x-app-layout>
    <div class="py-16 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-12">
                <a href="{{ route('vendor.my-products') }}" class="p-3 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:text-primary transition group">
                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ __('messages.vendor_dashboard_keys.edit') }}</h1>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-1 italic">{{ $product->name }}</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[3rem] p-8 md:p-16 border border-gray-100 dark:border-gray-700">
                <form action="{{ route('vendor.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf @method('PUT')

                    <div class="space-y-8">
                        <h2 class="text-xs font-black text-primary uppercase tracking-[0.3em] pb-2 border-b border-gray-50 dark:border-gray-700">{{ __('messages.create_product.basic_info') }}</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="col-span-1 md:col-span-2">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.model') }}</label>
                                <input type="text" name="name" required value="{{ $product->name }}" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold text-lg transition shadow-inner">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.category') }}</label>
                                <select name="category" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->slug }}" {{ $product->category == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.price') }}</label>
                                <input type="number" name="price" required value="{{ $product->price }}" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold text-lg transition shadow-inner">
                            </div>
                            
                            <!-- Additional Fields -->
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.year') }}</label>
                                <input type="number" name="year" value="{{ $product->year }}" placeholder="2024" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.location') }}</label>
                                <input type="text" name="location" value="{{ $product->location }}" placeholder="Np. Warszawa" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl py-4 px-6 focus:ring-primary focus:border-primary font-bold transition shadow-inner">
                            </div>

                            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 px-1">{{ __('messages.create_product.condition') }}</label>
                                <div class="flex bg-gray-100/50 dark:bg-gray-900 p-1.5 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-inner">
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="condition" value="new" class="sr-only peer" {{ $product->condition == 'new' ? 'checked' : '' }}>
                                        <div class="py-3 text-center rounded-xl font-black text-[10px] uppercase tracking-widest transition-all peer-checked:bg-primary peer-checked:text-white peer-checked:shadow-md text-gray-500 hover:text-gray-900 dark:hover:text-white">{{ __('messages.create_product.new') }}</div>
                                    </label>
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="condition" value="used" class="sr-only peer" {{ $product->condition == 'used' ? 'checked' : '' }}>
                                        <div class="py-3 text-center rounded-xl font-black text-[10px] uppercase tracking-widest transition-all peer-checked:bg-primary peer-checked:text-white peer-checked:shadow-md text-gray-500 hover:text-gray-900 dark:hover:text-white">{{ __('messages.create_product.used') }}</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <h2 class="text-xs font-black text-primary uppercase tracking-[0.3em] pb-2 border-b border-gray-50 dark:border-gray-700">{{ __('messages.create_product.desc_media') }}</h2>
                        <textarea name="description" rows="6" class="w-full bg-gray-50/50 dark:bg-gray-900 border-gray-100 dark:border-gray-700 text-gray-900 dark:text-white rounded-[2rem] py-6 px-8 focus:ring-primary focus:border-primary font-medium text-lg leading-relaxed">{{ $product->description }}</textarea>
                        
                        <div id="photo-drop-zone" class="p-10 border-4 border-dashed border-gray-100 dark:border-gray-800 rounded-[3rem] text-center bg-gray-50 group hover:border-primary/20 transition-all cursor-pointer relative" onclick="document.getElementById('photo-input').click()">
                            <input type="file" id="photo-input" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                            @if($product->image)
                                <div id="upload-placeholder" class="hidden">
                                     <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-primary shadow-lg shadow-primary/10">
                                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                     </div>
                                </div>
                                <div id="image-preview">
                                    <img id="preview-img" src="{{ $product->image }}" alt="Preview" class="max-h-48 mx-auto rounded-2xl shadow-lg mb-4 object-cover">
                                    <p class="text-primary font-black uppercase text-[10px] tracking-widest">{{ __('messages.vendor_dashboard_keys.edit') }} ↻</p>
                                </div>
                            @else
                                <div id="upload-placeholder">
                                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-primary shadow-lg shadow-primary/10">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    </div>
                                    <p class="text-gray-900 dark:text-white font-black uppercase text-[10px] tracking-widest mb-2">{{ __('messages.create_product.add_photos') }}</p>
                                </div>
                                <div id="image-preview" class="hidden">
                                    <img id="preview-img" src="" alt="Preview" class="max-h-48 mx-auto rounded-2xl shadow-lg mb-4 object-cover">
                                </div>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-6 rounded-[2rem] font-black text-2xl shadow-2xl transition-all uppercase tracking-tight">
                        {{ __('messages.vendor_dashboard_keys.edit') }}
                    </button>
                </form>

                <script>
                    function previewImage(input) {
                        const placeholder = document.getElementById('upload-placeholder');
                        const preview = document.getElementById('image-preview');
                        const previewImg = document.getElementById('preview-img');
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                previewImg.src = e.target.result;
                                if(placeholder) placeholder.classList.add('hidden');
                                if(preview) preview.classList.remove('hidden');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
