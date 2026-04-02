<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-10">
                <a href="{{ route('messages.index') }}" class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:text-primary transition-colors group">
                    <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary/10 to-primary/20 flex items-center justify-center border-2 border-white dark:border-gray-800 shadow-sm text-primary font-black text-xl">
                    {{ substr($contact->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight font-display">{{ $contact->name }}</h1>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-1 italic">
                        @if($contact->role === 'vendor' && $contact->vendor)
                            {{ $contact->vendor->shop_name }}
                        @else
                            Użytkownik
                        @endif
                    </p>
                </div>
            </div>

            <!-- Messages Area -->
            <div class="bg-white dark:bg-gray-800 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.06)] rounded-[2.5rem] border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col h-[600px]">
                
                @if($product)
                    <div class="bg-gray-50 dark:bg-gray-900 p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden shadow-inner border border-gray-200 dark:border-gray-700">
                                <img src="{{ $product->image ?? 'https://via.placeholder.com/150' }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-black text-gray-900 dark:text-white uppercase tracking-tight text-sm">{{ $product->name }}</h3>
                                <div class="text-[10px] text-primary font-black uppercase tracking-widest mt-1">{{ number_format($product->price, 0, '.', ' ') }} PLN</div>
                            </div>
                        </div>
                        <a href="{{ route('products.show', $product) }}" class="text-[10px] font-black uppercase tracking-widest px-4 py-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-primary text-gray-500 hover:text-primary transition-colors">
                            Zobacz ogłoszenie
                        </a>
                    </div>
                @endif

                <div class="flex-1 overflow-y-auto p-8 space-y-6" id="messages-container">
                    @forelse($messages as $message)
                        @if($message->sender_id === Auth::id())
                            <!-- Sent Message -->
                            <div class="flex justify-end">
                                <div class="max-w-[75%]">
                                    <div class="bg-primary text-white p-5 rounded-[2rem] rounded-tr-sm shadow-md">
                                        <p class="text-sm font-medium leading-relaxed">{{ $message->body }}</p>
                                    </div>
                                    <div class="flex items-center justify-end gap-2 mt-2">
                                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $message->created_at->format('H:i') }}</span>
                                        @if($message->is_read)
                                            <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Received Message -->
                            <div class="flex justify-start">
                                <div class="max-w-[75%]">
                                    <div class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 p-5 rounded-[2rem] rounded-tl-sm border border-gray-200 dark:border-gray-700 shadow-sm">
                                        <p class="text-sm font-medium leading-relaxed">{{ $message->body }}</p>
                                    </div>
                                    <div class="flex items-center justify-start gap-2 mt-2">
                                        <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $message->created_at->format('H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="h-full flex flex-col items-center justify-center text-center opacity-50">
                            <svg class="w-12 h-12 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <p class="text-[10px] font-black uppercase tracking-widest">Napisz pierwszą wiadomość</p>
                        </div>
                    @endforelse
                </div>

                <!-- Input Area -->
                <div class="p-6 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700">
                    <form action="{{ route('messages.store', $contact) }}" method="POST" class="flex items-end gap-4">
                        @csrf
                        @if($product)
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @endif
                        <div class="flex-1">
                            <textarea name="body" required rows="1" placeholder="Napisz wiadomość..." class="w-full bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-3xl py-4 px-6 focus:ring-primary focus:border-primary resize-none shadow-sm text-sm font-medium transition-colors" style="min-height: 56px; max-height: 150px;"></textarea>
                        </div>
                        <button type="submit" class="p-4 bg-primary hover:bg-primary-dark text-white rounded-full shadow-lg shadow-primary/30 transform active:scale-95 transition-all w-14 h-14 flex items-center justify-center flex-shrink-0 group">
                            <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Auto scroll to bottom of messages
        const container = document.getElementById('messages-container');
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    </script>
</x-app-layout>
