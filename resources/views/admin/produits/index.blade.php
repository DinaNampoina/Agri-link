<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">{{ __('Gestion des produits') }}</h2>
            <a href="{{ route('admin.produits.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm">+ Ajouter</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="bg-brand-100 dark:bg-brand-800 text-brand-700 dark:text-brand-200 px-4 py-3 rounded-md">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-md">{{ session('error') }}</div>
            @endif

            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg overflow-hidden">
                <table class="w-full text-sm table-fixed">
                    <thead class="bg-brand-50 dark:bg-brand-800">
                        <tr>
                            <th class="w-1/2 px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">Nom</th>
                            <th class="w-1/4 px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">Annonces liées</th>
                            <th class="w-1/4 px-4 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-100 dark:divide-brand-800">
                        @foreach ($produits as $produit)
                            <tr class="hover:bg-brand-50/50 dark:hover:bg-brand-800/50">
                                <td class="px-4 py-3 text-left text-gray-800 dark:text-gray-200">{{ $produit->nom }}</td>
                                <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $produit->annonces_count }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.produits.edit', $produit) }}" class="text-accent-600 dark:text-accent-400 hover:underline">Modifier</a>
                                        <form action="{{ route('admin.produits.destroy', $produit) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
