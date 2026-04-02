<x-guest-layout>
    <div class="mb-10 text-center lg:text-left">
        <a href="/" class="lg:hidden inline-block mb-8">
             <span class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter italic font-display">otovend<span class="text-primary not-italic">.pl</span></span>
        </a>
        <h1 class="text-3xl font-black text-gray-900 dark:text-white uppercase tracking-tight mb-2">{{ __('messages.auth.register') }}</h1>
        <p class="text-gray-500 font-medium text-sm">{{ __('messages.no_account') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">{{ __('messages.name') }}</label>
            <input id="name" class="block w-full border-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-0 focus:border-primary transition-colors py-3.5 px-4 font-medium" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">{{ __('messages.email') }}</label>
            <input id="email" class="block w-full border-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-0 focus:border-primary transition-colors py-3.5 px-4 font-medium" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">{{ __('messages.password') }}</label>
            <input id="password" class="block w-full border-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-0 focus:border-primary transition-colors py-3.5 px-4 font-medium"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">{{ __('messages.confirm_password') }}</label>
            <input id="password_confirmation" class="block w-full border-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white rounded-xl focus:ring-0 focus:border-primary transition-colors py-3.5 px-4 font-medium"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white py-4 rounded-xl font-black text-lg transition-all transform active:scale-[0.98] uppercase tracking-tight shadow-md">
                {{ __('messages.create_account') }}
            </button>
        </div>

        <div class="text-center mt-8 pt-6 border-t border-gray-100 dark:border-gray-800">
            <span class="text-gray-400 text-sm">{{ __('messages.already_registered') }} </span>
            <a href="{{ route('login') }}" class="text-sm font-black text-gray-900 dark:text-white hover:text-primary transition uppercase tracking-widest ml-1">
                {{ __('messages.auth.login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
