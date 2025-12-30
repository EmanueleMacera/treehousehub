<?php

use App\Http\Controllers\Sitemap\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    return response(view('seo.robots'), 200, ['Content-Type' => 'text/plain']);
})->name('robots');
