<?php

namespace App\Http\Controllers\Sitemap;

use App\Http\Controllers\Controller;
use App\Models\SaleProperty;
use App\Models\Structure;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $locales = ['it', 'en'];
        $urls = [];

        foreach ($locales as $locale) {
            $urls[] = url("/$locale");
            $urls[] = url("/$locale/affitti");
            $urls[] = url("/$locale/vendite");
            $urls[] = url("/$locale/chi-siamo");
            $urls[] = url("/$locale/diventa-proprietario");
            $urls[] = url("/$locale/contatti");

            foreach (Structure::query()->where('active', true)->get(['slug']) as $s) {
                $urls[] = url("/$locale/affitti/{$s->slug}");
            }

            foreach (SaleProperty::query()->where('active', true)->get(['slug']) as $p) {
                $urls[] = url("/$locale/vendite/{$p->slug}");
            }
        }

        $xml = view('seo.sitemap', compact('urls'))->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
