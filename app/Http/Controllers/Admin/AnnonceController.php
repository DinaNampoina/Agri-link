<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Annonce;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::with(['user', 'produit'])->latest()->get();

        return view('admin.annonces.index', compact('annonces'));
    }

    public function destroy(Annonce $annonce)
    {
        Storage::disk('public')->delete($annonce->chemin_image);
        $annonce->delete();

        return redirect()->route('admin.annonces.index')->with('success', 'Annonce supprimée.');
    }
}
