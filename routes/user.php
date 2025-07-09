<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Properties\PropertyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth', 'role:user')->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })
        ->name('dashboard');

    Route::get('favorites', [PropertyController::class, 'showFavorites'])
        ->name('show.favorites');

    Route::get('profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('properties/list', [PropertyController::class, 'create'])
        ->name('properties.create');

    Route::post('properties/list', [PropertyController::class, 'store'])
        ->name('properties.store');

    Route::get('my-properties', [PropertyController::class, 'userProperties'])
        ->name('properties.userProperties');

    Route::patch('my-properties/{property}', [PropertyController::class, 'update'])
        ->name('properties.update');

    Route::delete('my-properties/{id}', [PropertyController::class, 'destroy'])
        ->name('properties.destroy');

    Route::get('/message', [MessageController::class, 'show'])
        ->name('message.show');

    Route::post('/message/{property:slug}', [MessageController::class, 'store'])
        ->name('message.store');
});
