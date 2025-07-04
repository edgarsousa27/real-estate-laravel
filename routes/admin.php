<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ChartsController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Contract\RentController;
use App\Http\Controllers\Contract\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'role:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('properties', [AdminController::class, 'indexProperties'])
        ->name('admin.properties');

    Route::get('properties/{property:slug}', [AdminController::class, 'show'])
        ->name('admin.properties.show');

    Route::get('properties/{property:slug}/documents', [AdminController::class, 'downloadDocuments'])
        ->name('admin.properties.documents');

    Route::patch('properties/{property:slug}/update', [AdminController::class, 'update'])
        ->name('admin.properties.update');

    Route::post('properties/{property:slug}/contract/purchase', [SaleController::class, 'store'])
        ->name('admin.properties.accept');

    Route::get('properties/{property:slug}/contract/purchase', [SaleController::class, 'index'])
        ->name('admin.properties.registersale');

    Route::get('properties/{property:slug}/contract/rent', [RentController::class, 'index'])
        ->name('admin.properties.registerrent');

    Route::post('properties/{property:slug}/contract/rent', [RentController::class, 'store'])
        ->name('admin.properties.acceptrent');

    Route::get('clients', [ClientController::class, 'index'])
        ->name('admin.clients');

    Route::get('clients/{client}', [ClientController::class, 'show'])
        ->name('admin.clients.show');

    Route::get('calendar', [CalendarController::class, 'index'])
        ->name('admin.calendar');

    Route::post('calendar', [CalendarController::class, 'store'])
        ->name('admin.calendar.store');

    Route::get('calendar/json', [CalendarController::class, 'json'])
        ->name('admin.calendar.json');

    Route::delete('calendar/{id}', [CalendarController::class, 'destroy'])
        ->name('admin.calendar.destroy');

    Route::patch('calendar/{id}', [CalendarController::class, 'update'])
        ->name('admin.calendar.update');

    Route::get('analytics', [ChartsController::class, 'index'])
        ->name('admin.analytics');
});
