<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\Etape9Controller;

Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('a-propos');

// Route::get('/contenus', [ContenuController::class, 'index']);
Route::resource('contenus', ContenuController::class);
// Route::get('/contenus/{id}', [ContenuController::class, 'show'])->name('contenus.show');

Route::get('/etape9', [Etape9Controller::class, 'msg'])->name('categories.index');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])->name('dashboard');
});
