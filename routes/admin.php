<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SalePropertyController;
use App\Http\Controllers\Admin\StructureController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {
        Route::redirect('/', '/admin/pages/about')->name('home');

        Route::get('/pages/{key}', [PageController::class, 'edit'])->name('pages.edit');
        Route::post('/pages/{key}', [PageController::class, 'update'])->name('pages.update');

        Route::resource('structures', StructureController::class)->except(['show']);
        Route::resource('sales', SalePropertyController::class)->except(['show'])->parameters([
            'sales' => 'sale',
        ]);
    });
