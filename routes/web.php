<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\OwnersController;
use App\Http\Controllers\Public\RentalsController;
use App\Http\Controllers\Public\SalesController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/seo.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/legal.php';

Route::redirect('/', '/it');

Route::prefix('{locale}')
    ->where(['locale' => 'it|en'])
    ->middleware([SetLocale::class])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::prefix('affitti')->name('rentals.')->group(function () {
            Route::get('/', [RentalsController::class, 'index'])->name('index');
            Route::get('/{slug}', [RentalsController::class, 'show'])->name('show');
        });

        Route::prefix('vendite')->name('sales.')->group(function () {
            Route::get('/', [SalesController::class, 'index'])->name('index');
            Route::get('/{slug}', [SalesController::class, 'show'])->name('show');
        });

        Route::get('/diventa-proprietario', [OwnersController::class, 'index'])->name('owners');
        Route::get('/chi-siamo', [AboutController::class, 'index'])->name('about');

        Route::get('/contatti', [ContactController::class, 'index'])->name('contact');
        Route::post('/contatti', [ContactController::class, 'submit'])->name('contact.submit');
    });

require __DIR__ . '/admin.php';
