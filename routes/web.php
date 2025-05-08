<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Properties\PropertyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PropertyController::class, 'welcome'])->name('welcome');
Route::get('/search', [PropertyController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['verified'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('properties/list', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('properties/list', [PropertyController::class, 'store'])->name('properties.store');
});

Route::prefix('properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties');
});

require __DIR__.'/auth.php';
