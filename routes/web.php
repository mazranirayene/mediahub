<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');

Route::middleware('auth')->group(function () {
    Route::resource('contenus', ContenuController::class)
        ->parameters(['contenus' => 'publication'])
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
});
Route::resource('contenus', ContenuController::class)->parameters(['contenus' => 'publication'])->except(['create', 'store', 'edit', 'update', 'destroy']);

// Route::get('/contenus', [ContenuController::class, 'index']);
// Route::get('/contenus/{id}', [ContenuController::class, 'show'])->name('contenus.show');
// Route::get('/etape9', [Etape9Controller::class, 'msg'])->name('categories.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])->name('dashboard');
});

// Categorie
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{categorie}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{categorie}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categorie}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// User

// Route::middleware('guest')->group(function () {
// inscription
Route::get('/inscription', [AuthController::class, 'create'])
    ->name('inscription');
Route::post('/inscription', [AuthController::class, 'store'])
    ->name('inscription.store');
// connexion
Route::get('/connexion', [AuthController::class, 'creerConnexion'])
    ->name('connexion');
Route::post('/connexion', [AuthController::class, 'connecter'])
    ->name('connexion.store');
// });
// deconnexion
// Route::middleware('auth')->group(function () {
Route::post('/deconnexion', [AuthController::class, 'deconnecter'])
    ->name('deconnexion');
// });
