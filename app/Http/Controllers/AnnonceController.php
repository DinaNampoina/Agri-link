<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::where('user_id', Auth::id())->latest()->get();
        return view('annonces.index', compact('annonces'));
    }

    public function create()
    {
        $produits = Produit::all();
        return view('annonces.create', compact('produits'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantite' => ['required', 'numeric', 'min:0.1'],
            'unite' => ['required'],
            'nouvelle_unite' => ['required_if:unite,autre', 'nullable', 'string', 'max:50'],
            'prix' => ['required', 'numeric', 'min:0'],
            'region' => ['required'],
            'nouvelle_region' => ['required_if:region,autre', 'nullable', 'string', 'max:255'],
            'produit_id' => ['required'],
            'nouveau_produit' => ['required_if:produit_id,autre', 'nullable', 'string', 'max:255'],
            'chemin_image' => ['required', 'image', 'max:2048'],
        ]);

        if ($validated['produit_id'] === 'autre') {
            $nom = ucfirst(strtolower(trim($validated['nouveau_produit'])));
            $produit = Produit::firstOrCreate(['nom' => $nom]);
            $validated['produit_id'] = $produit->id;
        } else {
            Produit::findOrFail($validated['produit_id']);
        }

        if ($validated['unite'] === 'autre') {
            $validated['unite'] = trim($validated['nouvelle_unite']);
        }

        if ($validated['region'] === 'autre') {
            $validated['region'] = trim($validated['nouvelle_region']);
        }

        unset($validated['nouveau_produit'], $validated['nouvelle_unite'], $validated['nouvelle_region']);

        $validated['chemin_image'] = $request->file('chemin_image')->store('annonces', 'public');
        $validated['user_id'] = Auth::id();
        $validated['statut'] = 'disponible';

        Annonce::create($validated);

        return redirect()->route('annonces.index')->with('success', 'Votre annonce a bien été publiée !');
    }

    public function show(string $id)
{
    $annonce = Annonce::with(['user', 'produit'])->findOrFail($id);

    return view('annonces.show', compact('annonce'));
}

    public function edit(string $id)
    {
        $annonce = Annonce::findOrFail($id);

        abort_if($annonce->user_id !== Auth::id(), 403);

        $produits = Produit::all();

        return view('annonces.edit', compact('annonce', 'produits'));
    }

    public function update(Request $request, string $id)
    {
        $annonce = Annonce::findOrFail($id);

        abort_if($annonce->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantite' => ['required', 'numeric', 'min:0.1'],
            'unite' => ['required'],
            'nouvelle_unite' => ['required_if:unite,autre', 'nullable', 'string', 'max:50'],
            'prix' => ['required', 'numeric', 'min:0'],
            'region' => ['required'],
            'nouvelle_region' => ['required_if:region,autre', 'nullable', 'string', 'max:255'],
            'produit_id' => ['required'],
            'nouveau_produit' => ['required_if:produit_id,autre', 'nullable', 'string', 'max:255'],
            'chemin_image' => ['nullable', 'image', 'max:2048'],
            'statut' => ['required', 'in:disponible,vendue'],
        ]);

        if ($validated['produit_id'] === 'autre') {
            $produit = Produit::firstOrCreate(['nom' => ucfirst(strtolower(trim($validated['nouveau_produit'])))]);
            $validated['produit_id'] = $produit->id;
        } else {
            Produit::findOrFail($validated['produit_id']);
        }

        if ($validated['unite'] === 'autre') {
            $validated['unite'] = trim($validated['nouvelle_unite']);
        }

        if ($validated['region'] === 'autre') {
            $validated['region'] = trim($validated['nouvelle_region']);
        }

        unset($validated['nouveau_produit'], $validated['nouvelle_unite'], $validated['nouvelle_region']);

        if ($request->hasFile('chemin_image')) {
            Storage::disk('public')->delete($annonce->chemin_image);
            $validated['chemin_image'] = $request->file('chemin_image')->store('annonces', 'public');
        }

        $annonce->update($validated);

        return redirect()->route('annonces.index')->with('success', 'Annonce mise à jour avec succès !');
    }

    public function destroy(string $id)
    {
        $annonce = Annonce::findOrFail($id);

        abort_if($annonce->user_id !== Auth::id(), 403);

        Storage::disk('public')->delete($annonce->chemin_image);
        $annonce->delete();

        return redirect()->route('annonces.index')->with('success', 'Annonce supprimée avec succès !');
    }
}
