<?php

use App\Http\Controllers\Admin\DashboardController;
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
        Route::resource('sales', SalePropertyController::class)->except(['show'])->parameters([
            'sales' => 'sale',
        ]);
    });
