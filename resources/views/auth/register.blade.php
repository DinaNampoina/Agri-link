<x-guest-layout>
    <div class="text-center mb-6">
        <h1 class="text-xl font-bold text-brand-700 dark:text-brand-400">Créer un compte vendeur</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Publiez vos produits en quelques minutes</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Numéro de téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="tel" name="telephone" :value="old('telephone')" required autocomplete="tel" placeholder="034 12 345 67" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="localisation" :value="__('Localisation (district, commune)')" />
            <x-text-input id="localisation" class="block mt-1 w-full" type="text" name="localisation" :value="old('localisation')" required autocomplete="off" />
            <x-input-error :messages="$errors->get('localisation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-2.5">
                {{ __('Créer mon compte') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-gray-600 dark:text-gray-400 mt-6">
            {{ __('Déjà inscrit ?') }}
            <a href="{{ route('login') }}" class="text-accent-600 dark:text-accent-400 font-medium hover:underline">{{ __('Se connecter') }}</a>
        </p>
    </form>
</x-guest-layout>
