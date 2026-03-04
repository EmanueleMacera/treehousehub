<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Structure;

class RentalsController extends Controller
{
    public function index()
    {
        $structures = Structure::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.rentals.index', compact('structures'));
    }

    public function show(Structure $structure)
    {
        abort_unless($structure->active, 404);

        $otherStructures = Structure::query()
            ->where('active', true)
            ->where('id', '!=', $structure->id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('public.rentals.show', compact('structure', 'otherStructures'));
    }
}
