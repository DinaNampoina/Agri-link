<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">{{ __('Vendeurs') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-brand-50 dark:bg-brand-800 text-left">
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Téléphone</th>
                            <th class="px-4 py-2">Localisation</th>
                            <th class="px-4 py-2">Annonces</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-t border-brand-100 dark:border-brand-800">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->telephone }}</td>
                                <td class="px-4 py-2">{{ $user->localisation }}</td>
                                <td class="px-4 py-2">{{ $user->annonces_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
