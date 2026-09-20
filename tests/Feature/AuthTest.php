<?php

use App\Models\User;

test('un visiteur peut s\'inscrire avec un téléphone', function () {
    $response = $this->post('/register', [
        'name' => 'Test Vendeur',
        'telephone' => '0341112233',
        'localisation' => 'Antsirabe',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertDatabaseHas('users', [
        'telephone' => '0341112233',
        'role' => 'vendeur',
    ]);
});

test('un utilisateur ne peut pas s\'inscrire en tant qu\'admin via le formulaire public', function () {
    $this->post('/register', [
        'name' => 'Fraudeur',
        'telephone' => '0341112244',
        'localisation' => 'Antsirabe',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'admin',
    ]);

    $this->assertDatabaseHas('users', [
        'telephone' => '0341112244',
        'role' => 'vendeur',
    ]);
});

test('un utilisateur peut se connecter avec son téléphone', function () {
    $user = User::factory()->create([
        'telephone' => '0341112255',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->post('/login', [
        'telephone' => '0341112255',
        'password' => 'password123',
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticatedAs($user);
});
