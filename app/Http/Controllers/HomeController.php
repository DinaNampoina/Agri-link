<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $annonces = Annonce::with(['user', 'produit'])
            ->where('statut', 'disponible')
            ->when($request->filled('produit_id'), fn ($q) => $q->where('produit_id', $request->produit_id))
            ->when($request->filled('region'), fn ($q) => $q->where('region', $request->region))
            ->when($request->filled('prix_max'), fn ($q) => $q->where('prix', '<=', $request->prix_max))
            ->when($request->filled('q'), fn ($q) => $q->where('titre', 'like', '%' . $request->q . '%'))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $produits = Produit::orderBy('nom')->get();

        $regions = Annonce::where('statut', 'disponible')->distinct()->pluck('region');

        return view('welcome', compact('annonces', 'produits', 'regions'));
    }
}
