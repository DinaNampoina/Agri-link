<x-layouts.public>
    <div class="w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-brand-700 dark:text-brand-400">🌿 AgriLink</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">Marketplace agricole de proximité — Vakinankaratra</p>
        </div>

        <form method="GET" action="{{ route('home') }}" class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-4 grid grid-cols-1 sm:grid-cols-4 gap-3 mb-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher un produit..." class="border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:col-span-2">

            <select name="produit_id" class="border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500">
                <option value="">Tous les produits</option>
                @foreach ($produits as $produit)
                    <option value="{{ $produit->id }}" {{ request('produit_id') == $produit->id ? 'selected' : '' }}>{{ $produit->nom }}</option>
                @endforeach
            </select>

            <select name="region" class="border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500">
                <option value="">Toutes les régions</option>
                @foreach ($regions as $region)
                    <option value="{{ $region }}" {{ request('region') == $region ? 'selected' : '' }}>{{ $region }}</option>
                @endforeach
            </select>

            <input type="number" name="prix_max" value="{{ request('prix_max') }}" placeholder="Prix max (Ar)" class="border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500">

            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm font-semibold py-2 sm:col-span-1">Filtrer</button>

            @if (request()->anyFilled(['q', 'produit_id', 'region', 'prix_max']))
                <a href="{{ route('home') }}" class="text-center text-sm text-accent-600 dark:text-accent-400 py-2">Réinitialiser</a>
            @endif
        </form>

        @if ($annonces->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-400 py-12">Aucune annonce ne correspond à votre recherche.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($annonces as $annonce)
                    <a href="{{ route('annonces.show', $annonce) }}" class="bg-white dark:bg-brand-900 shadow-sm rounded-lg overflow-hidden hover:shadow-md transition">
                        <img src="{{ asset('storage/' . $annonce->chemin_image) }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $annonce->titre }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $annonce->produit->nom }} — {{ $annonce->region }}</p>
                            <p class="text-brand-600 dark:text-brand-400 font-semibold mt-1">{{ number_format($annonce->prix, 0, ',', ' ') }} Ar / {{ $annonce->unite }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $annonces->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
