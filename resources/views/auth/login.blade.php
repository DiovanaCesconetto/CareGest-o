<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full border border-primary-500 rounded-md
                       focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                       dark:focus:ring-primary-200 transition duration-150 ease-in-out" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full border border-primary-500 rounded-md
                       focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                       dark:focus:ring-primary-200 transition duration-150 ease-in-out" 
                type="password" 
                name="password" 
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-primary-500 text-primary-600 shadow-sm
                           focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                           dark:focus:ring-primary-200 transition duration-150 ease-in-out" 
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Lembrar Senha ') }}</span>
            </label>
        </div>

        <!-- Links e Botão -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a 
                    href="{{ route('password.request') }}" 
                    class="underline text-sm text-primary-500 hover:text-primary-700
                           rounded-md focus:outline-none focus:ring-2 focus:ring-primary-200
                           focus:ring-offset-2 dark:focus:ring-primary-200 transition duration-150 ease-in-out"
                >
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-primary-500 border border-primary-700
                                   hover:bg-primary-600 hover:border-primary-800
                                   focus:ring-2 focus:ring-primary-200 focus:ring-offset-2
                                   dark:focus:ring-primary-200 transition duration-150 ease-in-out">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
