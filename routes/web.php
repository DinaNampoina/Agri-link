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

Route::resource('annonces', AnnonceController::class)
    ->except(['create', 'store', 'edit', 'update', 'destroy']);

Route::middleware('auth')->group(function () {
    Route::resource('annonces', AnnonceController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
