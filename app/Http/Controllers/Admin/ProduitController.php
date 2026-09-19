<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::withCount('annonces')->orderBy('nom')->get();

        return view('admin.produits.index', compact('produits'));
    }

    public function create()
    {
        return view('admin.produits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:produits,nom'],
        ]);

        Produit::create($validated);

        return redirect()->route('admin.produits.index')->with('success', 'Produit ajouté.');
    }

    public function edit(Produit $produit)
    {
        return view('admin.produits.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'unique:produits,nom,' . $produit->id],
        ]);

        $produit->update($validated);

        return redirect()->route('admin.produits.index')->with('success', 'Produit modifié.');
    }

    public function destroy(Produit $produit)
    {
        if ($produit->annonces()->exists()) {
            return back()->with('error', 'Impossible de supprimer : des annonces utilisent ce produit.');
        }

        $produit->delete();

        return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé.');
    }
}
