<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\CategoryController;

Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');

// Route::get('/contenus', [ContenuController::class, 'index']);
Route::resource('contenus', ContenuController::class)->parameters(['contenus' => 'publication']);
// Route::get('/contenus/{id}', [ContenuController::class, 'show'])->name('contenus.show');

// Route::get('/etape9', [Etape9Controller::class, 'msg'])->name('categories.index');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])->name('dashboard');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{categorie}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{categorie}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{categorie}', [CategoryController::class, 'destroy'])->name('categories.destroy');
