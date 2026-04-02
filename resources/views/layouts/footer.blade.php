<footer class="bg-gray-900 text-gray-300 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <!-- Brand Column -->
            <div class="col-span-1 md:col-span-1">
                <span class="text-3xl font-black text-white tracking-tighter italic mb-6 block">otovend<span class="text-primary not-italic">.pl</span></span>
                <p class="text-sm leading-relaxed mb-6">
                    Największa w Polsce giełda automatów vendingowych, części oraz serwisu. Dołącz do tysięcy zadowolonych przedsiębiorców.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Links Columns -->
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Menu</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-primary transition">Strona główna</a></li>
                    <li><a href="#" class="hover:text-primary transition">O nas</a></li>
                    <li><a href="#" class="hover:text-primary transition">Blog</a></li>
                    <li><a href="#" class="hover:text-primary transition">Kontakt</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Dla kupujących</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="#" class="hover:text-primary transition">Jak kupować</a></li>
                    <li><a href="#" class="hover:text-primary transition">Bezpieczeństwo</a></li>
                    <li><a href="#" class="hover:text-primary transition">Centrum pomocy</a></li>
                    <li><a href="{{ route('orders.index') }}" class="hover:text-primary transition">Twoje zamówienia</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Dla sprzedawców</h4>
                <ul class="space-y-4 text-sm">
                    <li><a href="{{ route('vendor.dashboard') }}" class="hover:text-primary transition">Twoje konto</a></li>
                    <li><a href="{{ route('vendor.products.create') }}" class="hover:text-primary transition">Wystaw ogłoszenie</a></li>
                    <li><a href="#" class="hover:text-primary transition">Promowanie ofert</a></li>
                    <li><a href="#" class="hover:text-primary transition">Regulamin serwisu</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-12 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-xs text-gray-500">&copy; {{ date('Y') }} Otovend.pl. Wszelkie prawa zastrzeżone.</p>
            <div class="flex items-center gap-6 text-[10px] font-bold uppercase tracking-widest text-gray-600">
                <a href="#" class="hover:text-white transition">Polityka prywatności</a>
                <a href="#" class="hover:text-white transition">Cookies</a>
                <a href="#" class="hover:text-white transition">RODO</a>
            </div>
        </div>
    </div>
</footer>
