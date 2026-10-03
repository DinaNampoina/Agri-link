<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produits = [
            'Tomate',
            'Pomme de terre',
            'Carotte',
            'Oignon',
            'Chou',
            'Haricot',
            'Riz',
            'Maïs',
        ];

        foreach ($produits as $nom) {
            Produit::create(['nom' => $nom]);
        }
    }
}
