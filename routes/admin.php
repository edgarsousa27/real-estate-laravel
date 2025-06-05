<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Contract\RentController;
use App\Http\Controllers\Contract\SaleController;
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

    Route::get('/admin/properties/{contract}/contract-sale/download', [SaleController::class, 'downloadSalesContracts'])
        ->name('contract.sale.download');

    Route::get('/admin/properties/{contract}/contract-rent/download', [RentController::class, 'downloadRentContracts'])
        ->name('contract.rent.download');

    Route::get('/admin/clients', [ClientController::class, 'index'])
        ->name('admin.clients');
});
