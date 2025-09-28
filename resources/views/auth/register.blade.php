<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input 
                id="name"
                name="name"
                type="text"
                :value="old('name')"
                required
                autofocus
                class="block mt-1 w-full border border-primary-500 rounded-md
                       focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                       dark:focus:ring-primary-200 transition duration-150 ease-in-out" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email"
                name="email"
                type="email"
                :value="old('email')"
                required
                class="block mt-1 w-full border border-primary-500 rounded-md
                       focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                       dark:focus:ring-primary-200 transition duration-150 ease-in-out" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input 
                id="password"
                name="password"
                type="password"
                required
                class="block mt-1 w-full border border-primary-500 rounded-md
                       focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                       dark:focus:ring-primary-200 transition duration-150 ease-in-out" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input 
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                class="block mt-1 w-full border border-primary-500 rounded-md
                       focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                       dark:focus:ring-primary-200 transition duration-150 ease-in-out" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="role" class="block text-sm font-medium">Tipo de usuário</label>
            <select 
                id="role" 
                name="role"
                required
                class="block mt-1 w-full border border-primary-500 rounded-md
                       focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:ring-offset-0
                       dark:focus:ring-primary-200 transition duration-150 ease-in-out">
                <option value="medico">Médico</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('login') }}" 
               class="underline text-sm text-primary-500 hover:text-primary-700 transition">
                {{ __('Já cadastrado?') }}
            </a>
            <x-primary-button class="ms-4 bg-primary-600 hover:bg-primary-700 text-white">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>