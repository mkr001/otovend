<x-guest-layout>
    <div class="mb-10 text-center lg:text-left">
        <a href="/" class="lg:hidden inline-block mb-8">
             <span class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter italic font-display">otovend<span class="text-primary not-italic">.pl</span></span>
        </a>
        <h1 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-2">{{ __('messages.auth.login') }}</h1>
        <p class="text-gray-500 font-medium text-sm">{{ __('messages.already_registered') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">{{ __('messages.email') }}</label>
            <input id="email" class="block w-full border-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-0 focus:border-primary transition-colors py-3.5 px-4 font-medium" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">{{ __('messages.password') }}</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-gray-400 hover:text-primary transition" href="{{ route('password.request') }}">
                        {{ __('messages.forgot_password') }}
                    </a>
                @endif
            </div>
            <input id="password" class="block w-full border-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-0 focus:border-primary transition-colors py-3.5 px-4 font-medium"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-2">
            <input id="remember_me" type="checkbox" class="w-5 h-5 rounded border-2 border-gray-300 text-primary shadow-sm focus:ring-primary focus:ring-offset-0 dark:bg-gray-800 dark:border-gray-600" name="remember">
            <label for="remember_me" class="ms-3 text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('messages.remember_me') }}</label>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-black text-lg transition-all transform active:scale-[0.98] uppercase tracking-tight shadow-md">
                {{ __('messages.auth.login') }}
            </button>
        </div>

        <div class="text-center mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
            <span class="text-gray-400 text-sm">{{ __('messages.no_account') }} </span>
            <a href="{{ route('register') }}" class="text-sm font-black text-gray-900 dark:text-white hover:text-primary transition uppercase tracking-widest ml-1">
                {{ __('messages.auth.register') }}
            </a>
        </div>
    </form>
</x-guest-layout>
