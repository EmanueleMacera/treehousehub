<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SalePropertyController;
use App\Http\Controllers\Admin\StructureController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', EnsureAdmin::class])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('structures', StructureController::class)->except(['show']);

        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/create', [CategoryController::class, 'createCategory'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'storeCategory'])->name('categories.store');
        Route::get('categories/{category}/edit', [CategoryController::class, 'editCategory'])->name('categories.edit');
        Route::put('categories/{category}', [CategoryController::class, 'updateCategory'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroyCategory'])->name('categories.destroy');

        Route::get('category-types/create', [CategoryController::class, 'createType'])->name('category-types.create');
        Route::post('category-types', [CategoryController::class, 'storeType'])->name('category-types.store');
        Route::get('category-types/{type}/edit', [CategoryController::class, 'editType'])->name('category-types.edit');
        Route::put('category-types/{type}', [CategoryController::class, 'updateType'])->name('category-types.update');
        Route::delete('category-types/{type}', [CategoryController::class, 'destroyType'])->name('category-types.destroy');
        Route::delete('category-type-media/{media}', [CategoryController::class, 'destroyTypeMedia'])->name('category-type-media.destroy');

        Route::resource('sales', SalePropertyController::class)->except(['show'])->parameters([
            'sales' => 'sale',
        ]);
    });
