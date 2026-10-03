<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('annonces.index') }}"
                class="text-gray-500 dark:text-gray-400 hover:text-brand-600">&larr;</a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Modifier l\'annonce') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('admin.produits.update', $produit) }}">
                    @csrf
                    @method('PUT')
                    <x-input-label for="nom" :value="__('Nom du produit')" />
                    <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom"
                        :value="old('nom', $produit->nom)" required autofocus />
                    <x-input-error :messages="$errors->get('nom')" class="mt-2" />

                    <div class="flex justify-end mt-6">
                        <x-primary-button>{{ __('Mettre à jour') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
