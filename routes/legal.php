<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')
    ->where(['locale' => 'it|en'])
    ->middleware([SetLocale::class])
    ->name('legal.')
    ->group(function () {
        Route::view('/privacy-policy', 'public.legal.privacy')->name('privacy');
        Route::view('/cookie-policy', 'public.legal.cookies')->name('cookies');
        Route::view('/termini-e-condizioni', 'public.legal.terms')->name('terms');
        Route::view('/note-legali', 'public.legal.legal-notice')->name('notice');
        Route::view('/accessibilita', 'public.legal.accessibility')->name('accessibility');
        Route::view('/preferenze-cookie', 'public.legal.cookie-preferences')->name('cookie_preferences');
    });
