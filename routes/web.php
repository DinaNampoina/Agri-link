<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    $annonces = Auth::user()->annonces();

    return view('dashboard', [
        'total' => $annonces->count(),
        'disponibles' => (clone $annonces)->where('statut', 'disponible')->count(),
        'vendues' => (clone $annonces)->where('statut', 'vendue')->count(),
    ]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('annonces', AnnonceController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::resource('annonces', AnnonceController::class)
    ->except(['create', 'store', 'edit', 'update', 'destroy']);


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('produits', \App\Http\Controllers\Admin\ProduitController::class)->except('show');
    Route::get('annonces', [\App\Http\Controllers\Admin\AnnonceController::class, 'index'])->name('annonces.index');
    Route::delete('annonces/{annonce}', [\App\Http\Controllers\Admin\AnnonceController::class, 'destroy'])->name('annonces.destroy');
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
});

require __DIR__ . '/auth.php';
