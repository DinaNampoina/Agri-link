<x-layouts.public>
    <div class="max-w-2xl mx-auto bg-white dark:bg-brand-900 shadow-sm rounded-lg overflow-hidden">
        <img src="{{ asset('storage/' . $annonce->chemin_image) }}" class="w-full h-64 object-cover">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $annonce->titre }}</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $annonce->produit->nom }} — {{ $annonce->region }}</p>
            <p class="text-2xl text-brand-600 dark:text-brand-400 font-semibold mt-4">
                {{ number_format($annonce->prix, 0, ',', ' ') }} Ar / {{ $annonce->unite }}
            </p>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Quantité disponible : {{ $annonce->quantite }} {{ $annonce->unite }}</p>

            @if ($annonce->description)
                <p class="text-gray-700 dark:text-gray-300 mt-4">{{ $annonce->description }}</p>
            @endif

            <div class="mt-6 bg-brand-50 dark:bg-brand-800 rounded-md p-4">
                <p class="text-sm text-gray-600 dark:text-gray-300">Vendeur : <strong>{{ $annonce->user->name }}</strong></p>
                <a href="tel:{{ $annonce->user->telephone }}" class="inline-block mt-2 bg-brand-600 hover:bg-brand-700 text-white px-4 py-2 rounded-md text-sm">
                    📞 Appeler {{ $annonce->user->telephone }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.public>
