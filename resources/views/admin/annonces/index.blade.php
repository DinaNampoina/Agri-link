<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-brand-600">&larr;</a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Mes annonces') }}</h2>
            </div>
            <a href="{{ route('annonces.create') }}" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-md text-sm">
                {{ __('+ Nouvelle annonce') }}
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div id="flash-message" class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-brand-100 dark:bg-brand-800 text-brand-700 dark:text-brand-200 px-4 py-3 rounded-md flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('flash-message').remove()" class="text-brand-700 dark:text-brand-200 font-bold text-lg leading-none">&times;</button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('flash-message');
                if (el) { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }
            }, 3000);
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if ($annonces->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">{{ __('Vous n\'avez pas encore publié d\'annonce.') }}</p>
            @endif

            @foreach ($annonces as $annonce)
                <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg p-4 flex items-center gap-4">
                    <img src="{{ asset('storage/' . $annonce->chemin_image) }}" class="w-20 h-20 object-cover rounded shrink-0">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $annonce->titre }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                            {{ $annonce->quantite }} {{ $annonce->unite }} — {{ $annonce->prix }} Ar — {{ $annonce->region }}
                        </p>
                    </div>
                    <span class="text-xs px-2 py-1 rounded shrink-0 {{ $annonce->statut === 'disponible' ? 'bg-brand-100 text-brand-700 dark:bg-brand-800 dark:text-brand-200' : 'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300' }}">
                        {{ $annonce->statut }}
                    </span>
                    <div class="flex items-center gap-3 shrink-0">
                        <a href="{{ route('annonces.edit', $annonce) }}" class="text-sm text-accent-600 dark:text-accent-400 hover:underline">Modifier</a>
                        <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" onsubmit="return confirm('Supprimer cette annonce ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
