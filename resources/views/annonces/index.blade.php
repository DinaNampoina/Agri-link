<x-app-layout>
    <x-slot name="header">
        @if (session('success'))
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-md">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mes annonces') }}
            </h2>
            <a href="{{ route('annonces.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">
                {{ __('+ Nouvelle annonce') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if ($annonces->isEmpty())
                <p class="text-gray-500">{{ __('Vous n\'avez pas encore publié d\'annonce.') }}</p>
            @endif

            @foreach ($annonces as $annonce)
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-4 flex items-center gap-4">
                    <img src="{{ asset('storage/' . $annonce->chemin_image) }}" class="w-20 h-20 object-cover rounded">
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $annonce->titre }}</h3>
                        <p class="text-sm text-gray-500">{{ $annonce->quantite }} {{ $annonce->unite }} —
                            {{ $annonce->prix }} Ar — {{ $annonce->region }}</p>
                        <span
                            class="text-xs px-2 py-1 rounded {{ $annonce->statut === 'disponible' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                            {{ $annonce->statut }}
                        </span>
                    </div>
                    <a href="{{ route('annonces.edit', $annonce) }}" class="text-sm text-indigo-600">Modifier</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
