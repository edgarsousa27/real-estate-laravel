<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Properties\PropertyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [PropertyController::class, 'welcome'])->name('welcome');

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
    Route::get('properties/my-properties', [PropertyController::class, 'userProperties'])->name('properties.userProperties');
    Route::patch('properties/my-properties', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('properties/my-properties/{id}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::get('/notifications', [ContactController::class, 'show'])->name('notifications');
});

Route::prefix('properties')->group(function () {
    Route::get('/', [PropertyController::class, 'index'])->name('properties');
    Route::get('/{slug}', [PropertyController::class, 'show'])->name('properties.show');
    Route::post('/{property:slug}/contact', [ContactController::class, 'store'])->name('properties.contact');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/properties', [AdminController::class, 'indexProperties'])->name('admin.properties');
    Route::get('/admin/properties/{property:slug}', [AdminController::class, 'show'])->name('admin.properties.show');
    Route::get('/admin/properties/{property:slug}/documents', [AdminController::class, 'downloadDocuments'])->name('admin.properties.documents');
    Route::patch('/admin/properties/{property:slug}/contract/upload', [AdminController::class, 'update'])->name('admin.properties.accept');
    Route::get('/admin/properties/{property:slug}/contract/purchase', [AdminController::class, 'registerSale'])->name('admin.properties.registersale');
});

require __DIR__.'/auth.php';
