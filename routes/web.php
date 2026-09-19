<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
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
