<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    Bonjour {{ auth()->user()->name }} 👋
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Voici un aperçu de votre activité sur AgriLink.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-brand-600 dark:text-brand-400">{{ $total }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Annonces publiées</p>
                </div>
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-brand-600 dark:text-brand-400">{{ $disponibles }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Disponibles</p>
                </div>
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 text-center">
                    <p class="text-3xl font-bold text-gray-500 dark:text-gray-400">{{ $vendues }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Vendues</p>
                </div>
            </div>

            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-6 flex flex-wrap gap-3">
                <a href="{{ route('annonces.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm">+ Publier une annonce</a>
                <a href="{{ route('annonces.index') }}" class="px-4 py-2 border border-accent-300 dark:border-accent-700 text-accent-700 dark:text-accent-300 rounded-md text-sm hover:bg-accent-50 dark:hover:bg-brand-800">Voir mes annonces</a>
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md text-sm hover:bg-gray-50 dark:hover:bg-brand-800">Modifier mon profil</a>
            </div>
        </div>
    </div>
</x-app-layout>
