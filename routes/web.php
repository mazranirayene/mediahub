<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContenuController;

Route::get('/', [PageController::class, 'accueil']);
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');

// Route::get('/contenus', [ContenuController::class, 'index']);
// Route::get('/contenus/{id}', [ContenuController::class, 'show'])->name('contenus.show');
Route::resource('/contenus', ContenuController::class);



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])->name('dashboard');
});
