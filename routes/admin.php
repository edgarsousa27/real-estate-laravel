<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ChartsController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Contract\RentController;
use App\Http\Controllers\Contract\SaleController;
use App\Models\CalendarEvents;
use Illuminate\Support\Facades\Route;


Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/properties', [AdminController::class, 'indexProperties'])
        ->name('admin.properties');

    Route::get('/admin/properties/{property:slug}', [AdminController::class, 'show'])
        ->name('admin.properties.show');

    Route::get('/admin/properties/{property:slug}/documents', [AdminController::class, 'downloadDocuments'])
        ->name('admin.properties.documents');

    Route::patch('/admin/properties/{property:slug}/update', [AdminController::class, 'update'])
        ->name('admin.properties.update');

    Route::post('/admin/properties/{property:slug}/contract/purchase', [SaleController::class, 'store'])
        ->name('admin.properties.accept');

    Route::get('/admin/properties/{property:slug}/contract/purchase', [SaleController::class, 'index'])
        ->name('admin.properties.registersale');

    Route::get('/admin/properties/{property:slug}/contract/rent', [RentController::class, 'index'])
        ->name('admin.properties.registerrent');

    Route::post('/admin/properties/{property:slug}/contract/rent', [RentController::class, 'store'])
        ->name('admin.properties.acceptrent');

    Route::get('/admin/clients', [ClientController::class, 'index'])
        ->name('admin.clients');

    Route::get('/admin/clients/{client}', [ClientController::class, 'show'])
        ->name('admin.clients.show');

    Route::get('/admin/calendar', [CalendarController::class, 'index'])
        ->name('admin.calendar');

    Route::post('/admin/calendar', [CalendarController::class, 'store'])
        ->name('admin.calendar.store');

    Route::get('/admin/calendar/json', [CalendarController::class, 'json'])
        ->name('admin.calendar.json');

    Route::delete('/admin/calendar/{id}', [CalendarController::class, 'destroy'])
        ->name('admin.calendar.destroy');

    Route::patch('/admin/calendar/{id}', [CalendarController::class, 'update'])
        ->name('admin.calendar.update');

    Route::get('/admin/analytics', [ChartsController::class, 'index'])
        ->name('admin.analytics');
});
