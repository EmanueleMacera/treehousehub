<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SaleProperty;

class SalesController extends Controller
{
    public function index()
    {
        $properties = SaleProperty::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.sales.index', compact('properties'));
    }

    public function show(string $slug)
    {
        $property = SaleProperty::query()
            ->where('active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.sales.show', compact('property'));
    }
}
