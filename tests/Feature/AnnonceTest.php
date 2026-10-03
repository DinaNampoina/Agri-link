<?php

use App\Models\Annonce;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
});

test('un vendeur connecté peut créer une annonce', function () {
    $user = User::factory()->create();
    $produit = Produit::factory()->create(['nom' => 'Tomate']);

    $response = $this->actingAs($user)->post('/annonces', [
        'titre' => 'Belles tomates',
        'quantite' => 10,
        'unite' => 'kg',
        'prix' => 2000,
        'region' => 'Betafo',
        'produit_id' => $produit->id,
        'chemin_image' => UploadedFile::fake()->image('tomate.jpg'),
    ]);

    $response->assertRedirect('/annonces');
    $this->assertDatabaseHas('annonces', [
        'titre' => 'Belles tomates',
        'user_id' => $user->id,
        'statut' => 'disponible',
    ]);
});

test('un vendeur ne peut pas modifier l\'annonce d\'un autre vendeur', function () {
    $proprietaire = User::factory()->create();
    $intrus = User::factory()->create();
    $produit = Produit::factory()->create();

    $annonce = Annonce::factory()->create([
        'user_id' => $proprietaire->id,
        'produit_id' => $produit->id,
    ]);

    $response = $this->actingAs($intrus)->get("/annonces/{$annonce->id}/edit");

    $response->assertForbidden();
});

test('un visiteur non connecté ne peut pas accéder au formulaire de création', function () {
    $response = $this->get('/annonces/create');

    $response->assertRedirect('/login');
});
