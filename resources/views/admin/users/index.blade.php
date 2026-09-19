<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">{{ __('Vendeurs') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-brand-900 shadow-sm rounded-lg overflow-hidden">
                <table class="w-full text-sm table-fixed">
                    <thead class="bg-brand-50 dark:bg-brand-800">
                        <tr>
                            <th class="w-1/4 px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">Nom</th>
                            <th class="w-1/4 px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">Téléphone</th>
                            <th class="w-1/4 px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">Localisation</th>
                            <th class="w-1/4 px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wide">Annonces</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brand-100 dark:divide-brand-800">
                        @foreach ($users as $user)
                            <tr class="hover:bg-brand-50/50 dark:hover:bg-brand-800/50">
                                <td class="px-4 py-3 text-left text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-left text-gray-600 dark:text-gray-400">{{ $user->telephone }}</td>
                                <td class="px-4 py-3 text-left text-gray-600 dark:text-gray-400">{{ $user->localisation }}</td>
                                <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $user->annonces_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
