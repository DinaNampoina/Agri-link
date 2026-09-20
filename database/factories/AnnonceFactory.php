<?php

namespace Database\Factories;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnonceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'quantite' => fake()->numberBetween(1, 100),
            'unite' => 'kg',
            'prix' => fake()->numberBetween(500, 5000),
            'region' => 'Betafo',
            'statut' => 'disponible',
            'chemin_image' => 'annonces/fake.jpg',
            'user_id' => User::factory(),
            'produit_id' => Produit::factory(),
        ];
    }
}
