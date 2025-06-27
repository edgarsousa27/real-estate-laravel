<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Properties\PropertyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PropertyController::class, 'welcome'])->name('welcome');

Route::post('/favorites', [PropertyController::class, 'storeFavorites'])
    ->name('store.favorites');

Route::delete('/favorites/{id}', [PropertyController::class, 'destroyFavorites'])
    ->name('destroy.favorites');

Route::get('/favorites', [PropertyController::class, 'showFavorites'])
    ->middleware('auth', 'role:user')
    ->name('show.favorites');

Route::prefix('search')->group(function () {
    Route::get('/buy', [PropertyController::class, 'searchBuy'])->name('search.buy');
    Route::get('/rent', [PropertyController::class, 'searchRent'])->name('search.rent');
});

Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['verified'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role:user')->group(function () {
    Route::get('properties/list', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('properties/list', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/dashboard/my-properties', [PropertyController::class, 'userProperties'])->name('properties.userProperties');
    Route::patch('properties/my-properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('properties/my-properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
});

Route::prefix('properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties');
    Route::get('/{slug}', [PropertyController::class, 'show'])->name('properties.show');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
