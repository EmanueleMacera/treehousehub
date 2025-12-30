<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StructureController extends Controller
{
    public function index()
    {
        $structures = Structure::query()->orderBy('sort_order')->get();
        return view('admin.structures.index', compact('structures'));
    }

    public function create()
    {
        return view('admin.structures.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        Structure::create($data);

        return redirect()->route('admin.structures.index')->with('status', __('admin.flash.saved'));
    }

    public function edit(Structure $structure)
    {
        return view('admin.structures.edit', compact('structure'));
    }

    public function update(Request $request, Structure $structure)
    {
        $data = $this->validateData($request, $structure->id);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $structure->update($data);

        return back()->with('status', __('admin.flash.saved'));
    }

    public function destroy(Structure $structure)
    {
        $structure->delete();
        return redirect()->route('admin.structures.index')->with('status', __('admin.flash.deleted'));
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $uniqueSlugRule = 'unique:structures,slug';
        if ($ignoreId) {
            $uniqueSlugRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            'location' => ['nullable', 'string', 'max:255'],
            'description_short' => ['nullable', 'string', 'max:500'],
            'description_long' => ['nullable', 'string'],
            'external_url' => ['nullable', 'url', 'max:255'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
