<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function index()
    {
        // Placeholder: nel prossimo step collegheremo il modello "immobile in vendita".
        return view('public.sales.index');
    }

    public function show(string $slug)
    {
        // Placeholder
        return view('public.sales.show', compact('slug'));
    }
}
