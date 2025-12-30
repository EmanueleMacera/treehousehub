<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Helper per ricavare la path senza locale (usato nello switch lingua del layout).
        if (!method_exists(\Illuminate\Http\Request::class, 'getPathInfoWithoutLocale')) {
            \Illuminate\Http\Request::macro('getPathInfoWithoutLocale', function () {
                /** @var \Illuminate\Http\Request $this */
                $path = '/' . ltrim($this->path(), '/');
                $segments = explode('/', trim($path, '/'));
                if (count($segments) > 0 && in_array($segments[0], ['it', 'en'], true)) {
                    array_shift($segments);
                }
                $result = '/' . implode('/', $segments);
                return $result === '/' ? '' : $result;
            });
        }
    }
}
