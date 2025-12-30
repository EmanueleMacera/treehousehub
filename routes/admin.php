<?php

use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pages/{key}', [PageController::class, 'edit'])->name('pages.edit');
    Route::post('/pages/{key}', [PageController::class, 'update'])->name('pages.update');
});
