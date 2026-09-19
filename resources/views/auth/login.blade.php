<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-xl font-bold text-brand-700 dark:text-brand-400">Connexion</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Accédez à votre espace vendeur</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Telephone -->
        <div>
            <x-input-label for="telephone" :value="__('Numéro de téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone')" required autofocus autocomplete="tel" placeholder="034 12 345 67" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-brand-900 border-brand-300 dark:border-brand-700 text-brand-600 shadow-sm focus:ring-brand-500 dark:focus:ring-brand-600 dark:focus:ring-offset-brand-900" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de moi') }}</span>
            </label>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-2.5">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
            {{ __('Pas encore de compte ?') }}
            <a href="{{ route('register') }}" class="text-accent-600 dark:text-accent-400 font-medium hover:underline">{{ __('Créer un compte vendeur') }}</a>
        </p>
    </form>
</x-guest-layout>
