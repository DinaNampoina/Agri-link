<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">{{ __('Toutes les annonces') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('success'))
                <div class="bg-brand-100 dark:bg-brand-800 text-brand-700 dark:text-brand-200 px-4 py-3 rounded-md">{{ session('success') }}</div>
            @endif

            @foreach ($annonces as $annonce)
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-4 flex items-center gap-4">
                    <img src="{{ asset('storage/' . $annonce->chemin_image) }}" class="w-16 h-16 object-cover rounded">
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $annonce->titre }}</h3>
                        <p class="text-sm text-gray-500">{{ $annonce->produit->nom }} — {{ $annonce->prix }} Ar/{{ $annonce->unite }} — {{ $annonce->region }}</p>
                        <p class="text-xs text-gray-400">Vendeur : {{ $annonce->user->name }} ({{ $annonce->user->telephone }})</p>
                    </div>
                    <span class="text-xs px-2 py-1 rounded {{ $annonce->statut === 'disponible' ? 'bg-brand-100 text-brand-700 dark:bg-brand-800 dark:text-brand-200' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">
                        {{ $annonce->statut }}
                    </span>
                    <form action="{{ route('admin.annonces.destroy', $annonce) }}" method="POST" onsubmit="return confirm('Supprimer cette annonce ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600">Supprimer</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
