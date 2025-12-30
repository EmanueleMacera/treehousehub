<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function edit(string $key)
    {
        $page = Page::query()->where('key', $key)->firstOrFail();

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, string $key)
    {
        $page = Page::query()->where('key', $key)->firstOrFail();

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);

        $page->update($data);

        return back()->with('status', __('admin.flash.saved'));
    }
}
