<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\RentalsController;
use App\Http\Controllers\Public\SalesController;
use App\Http\Controllers\Public\OwnersController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use Illuminate\Support\Facades\Route;

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
