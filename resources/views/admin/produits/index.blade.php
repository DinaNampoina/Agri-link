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
                <table class="w-full text-sm">
                    <thead class="bg-brand-50 dark:bg-brand-800 text-left">
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Annonces liées</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr class="border-t border-brand-100 dark:border-brand-800">
                                <td class="px-4 py-2">{{ $produit->nom }}</td>
                                <td class="px-4 py-2">{{ $produit->annonces_count }}</td>
                                <td class="px-4 py-2 flex gap-3">
                                    <a href="{{ route('admin.produits.edit', $produit) }}" class="text-accent-600 dark:text-accent-400">Modifier</a>
                                    <form action="{{ route('admin.produits.destroy', $produit) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
