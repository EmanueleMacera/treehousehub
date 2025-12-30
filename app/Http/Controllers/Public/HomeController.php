<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SaleProperty;
use App\Models\Structure;

class HomeController extends Controller
{
    public function index()
    {
        $featuredStructures = Structure::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $featuredSales = SaleProperty::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('public.home', compact('featuredStructures', 'featuredSales'));
    }
}
