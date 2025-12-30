<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class SetLocale
{
    /**
     * Supported locales for this project.
     */
    private const SUPPORTED = ['it', 'en'];

    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');

        if (!is_string($locale) || !in_array($locale, self::SUPPORTED, true)) {
            $locale = Config::get('app.locale', 'it');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
