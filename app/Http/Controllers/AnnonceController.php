<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnonceController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $produits= Produit::all();
        return view('annonces.create', compact('produits'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'quantite' => ['required', 'integer', 'min:1'],
        'unite' => ['required', 'string', 'max:50'],
        'prix' => ['required', 'numeric', 'min:0'],
        'region' => ['required', 'string', 'max:255'],
        'produit_id' => ['required', 'exists:produits,id'],
        'chemin_image' => ['required', 'image', 'max:2048'],
    ]);

    $validated['chemin_image'] = $request->file('chemin_image')->store('annonces', 'public');
    $validated['user_id'] = Auth::id();
    $validated['statut'] = 'disponible';

    Annonce::create($validated);

    return redirect()->route('annonces.index');
}

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
