<?php

use App\Http\Controllers\Properties\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'welcome'])->name('welcome');

Route::post('/favorites', [PropertyController::class, 'storeFavorites'])
    ->name('store.favorites');

Route::delete('/favorites/{id}', [PropertyController::class, 'destroyFavorites'])
    ->name('destroy.favorites');

Route::prefix('search')->group(function () {
    Route::get('/buy', [PropertyController::class, 'searchBuy'])->name('search.buy');
    Route::get('/rent', [PropertyController::class, 'searchRent'])->name('search.rent');
});

Route::prefix('properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties');
    Route::get('/{slug}', [PropertyController::class, 'show'])->name('properties.show');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
