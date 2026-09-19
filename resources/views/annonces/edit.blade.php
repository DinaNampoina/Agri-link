<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modifier l\'annonce') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('annonces.update', $annonce) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Titre -->
                    <div>
                        <x-input-label for="titre" :value="__('Titre')" />
                        <x-text-input id="titre" class="block mt-1 w-full" type="text" name="titre" :value="old('titre', $annonce->titre)" required autofocus />
                        <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                    </div>

                    <!-- Produit -->
                    <div class="mt-4">
                        <x-input-label for="produit_id" :value="__('Produit')" />
                        <select id="produit_id" name="produit_id" class="block mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500" onchange="document.getElementById('nouveau_produit_wrapper').style.display = this.value === 'autre' ? 'block' : 'none'">
                            <option value="">-- Choisir un produit --</option>
                            @foreach ($produits as $produit)
                                <option value="{{ $produit->id }}" {{ old('produit_id', $annonce->produit_id) == $produit->id ? 'selected' : '' }}>{{ $produit->nom }}</option>
                            @endforeach
                            <option value="autre" {{ old('produit_id') === 'autre' ? 'selected' : '' }}>-- Autre (préciser) --</option>
                        </select>
                        <x-input-error :messages="$errors->get('produit_id')" class="mt-2" />
                        <div id="nouveau_produit_wrapper" class="mt-2" style="display: {{ old('produit_id') === 'autre' ? 'block' : 'none' }}">
                            <x-text-input class="block mt-1 w-full" type="text" name="nouveau_produit" :value="old('nouveau_produit')" placeholder="{{ __('Nom du nouveau produit') }}" />
                            <x-input-error :messages="$errors->get('nouveau_produit')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description (optionnel)')" />
                        <textarea id="description" name="description" class="block mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500" rows="3">{{ old('description', $annonce->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Quantité -->
                    <div class="mt-4">
                        <x-input-label for="quantite" :value="__('Quantité')" />
                        <x-text-input id="quantite" class="block mt-1 w-full" type="number" step="0.1" name="quantite" :value="old('quantite', $annonce->quantite)" required min="0.1" />
                        <x-input-error :messages="$errors->get('quantite')" class="mt-2" />
                    </div>

                    <!-- Unité -->
                    <div class="mt-4">
                        <x-input-label for="unite" :value="__('Unité')" />
                        <select id="unite" name="unite" class="block mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500" onchange="document.getElementById('nouvelle_unite_wrapper').style.display = this.value === 'autre' ? 'block' : 'none'">
                            <option value="">-- Choisir --</option>
                            <option value="kg" {{ old('unite', $annonce->unite) == 'kg' ? 'selected' : '' }}>Kilogramme (kg)</option>
                            <option value="sac" {{ old('unite', $annonce->unite) == 'sac' ? 'selected' : '' }}>Sac</option>
                            <option value="régime" {{ old('unite', $annonce->unite) == 'régime' ? 'selected' : '' }}>Régime</option>
                            <option value="tas" {{ old('unite', $annonce->unite) == 'tas' ? 'selected' : '' }}>Tas</option>
                            <option value="unité" {{ old('unite', $annonce->unite) == 'unité' ? 'selected' : '' }}>À l'unité (pièce)</option>
                            <option value="autre" {{ old('unite') === 'autre' ? 'selected' : '' }}>-- Autre (préciser) --</option>
                        </select>
                        <x-input-error :messages="$errors->get('unite')" class="mt-2" />
                        <div id="nouvelle_unite_wrapper" class="mt-2" style="display: {{ old('unite') === 'autre' ? 'block' : 'none' }}">
                            <x-text-input class="block mt-1 w-full" type="text" name="nouvelle_unite" :value="old('nouvelle_unite')" placeholder="{{ __('Préciser l\'unité') }}" />
                        </div>
                    </div>

                    <!-- Prix -->
                    <div class="mt-4">
                        <x-input-label for="prix" :value="__('Prix PAR unité (Ar)')" />
                        <p class="text-xs text-gray-500 mt-1">{{ __('Exemple : si vous vendez au kilo, indiquez le prix d\'1 kg.') }}</p>
                        <x-text-input id="prix" class="block mt-1 w-full" type="number" name="prix" :value="old('prix', $annonce->prix)" required min="0" step="1" />
                        <x-input-error :messages="$errors->get('prix')" class="mt-2" />
                    </div>

                    <!-- Région -->
                    <div class="mt-4">
                        <x-input-label for="region" :value="__('Région / District')" />
                        <select id="region" name="region" class="block mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500" onchange="document.getElementById('nouvelle_region_wrapper').style.display = this.value === 'autre' ? 'block' : 'none'">
                            <option value="">-- Choisir --</option>
                            <option value="Antsirabe I" {{ old('region', $annonce->region) == 'Antsirabe I' ? 'selected' : '' }}>Antsirabe I</option>
                            <option value="Antsirabe II" {{ old('region', $annonce->region) == 'Antsirabe II' ? 'selected' : '' }}>Antsirabe II</option>
                            <option value="Betafo" {{ old('region', $annonce->region) == 'Betafo' ? 'selected' : '' }}>Betafo</option>
                            <option value="Faratsiho" {{ old('region', $annonce->region) == 'Faratsiho' ? 'selected' : '' }}>Faratsiho</option>
                            <option value="Andramasina" {{ old('region', $annonce->region) == 'Andramasina' ? 'selected' : '' }}>Andramasina</option>
                            <option value="Manjakandriana" {{ old('region', $annonce->region) == 'Manjakandriana' ? 'selected' : '' }}>Manjakandriana</option>
                            <option value="autre" {{ old('region') === 'autre' ? 'selected' : '' }}>-- Autre (préciser) --</option>
                        </select>
                        <x-input-error :messages="$errors->get('region')" class="mt-2" />
                        <div id="nouvelle_region_wrapper" class="mt-2" style="display: {{ old('region') === 'autre' ? 'block' : 'none' }}">
                            <x-text-input class="block mt-1 w-full" type="text" name="nouvelle_region" :value="old('nouvelle_region')" placeholder="{{ __('Préciser la localisation') }}" />
                        </div>
                    </div>

                    <!-- Statut -->
                    <div class="mt-4">
                        <x-input-label for="statut" :value="__('Statut')" />
                        <select id="statut" name="statut" class="block mt-1 w-full border-brand-200 dark:border-brand-700 dark:bg-brand-900 dark:text-gray-200 rounded-md shadow-sm focus:border-brand-500 focus:ring-brand-500">
                            <option value="disponible" {{ old('statut', $annonce->statut) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="vendue" {{ old('statut', $annonce->statut) == 'vendue' ? 'selected' : '' }}>Vendue</option>
                        </select>
                        <x-input-error :messages="$errors->get('statut')" class="mt-2" />
                    </div>

                    <!-- Photo -->
                    <div class="mt-4">
                        <x-input-label :value="__('Photo actuelle')" />
                        <img src="{{ asset('storage/' . $annonce->chemin_image) }}" class="w-32 h-32 object-cover rounded border mt-1">
                        <x-input-label for="chemin_image" :value="__('Changer la photo (optionnel)')" class="mt-3" />
                        <input id="chemin_image" type="file" name="chemin_image" class="block mt-1 w-full" accept="image/*" onchange="const p=document.getElementById('preview'); const f=this.files[0]; if(f){p.src=URL.createObjectURL(f); p.classList.remove('hidden');}">
                        <img id="preview" class="hidden mt-2 w-32 h-32 object-cover rounded border">
                        <x-input-error :messages="$errors->get('chemin_image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Mettre à jour') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
