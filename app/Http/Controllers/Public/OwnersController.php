<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class OwnersController extends Controller
{
    public function index()
    {
        return view('public.owners');
    }
}
