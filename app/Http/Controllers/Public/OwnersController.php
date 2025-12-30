<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;

class OwnersController extends Controller
{
    public function index()
    {
        $page = Page::query()->where('key', 'owners')->first();

        return view('public.owners', compact('page'));
    }
}
