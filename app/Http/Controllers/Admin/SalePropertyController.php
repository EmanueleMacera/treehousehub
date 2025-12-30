<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SalePropertyController extends Controller
{
    public function index()
    {
        $properties = SaleProperty::query()->orderBy('sort_order')->get();
        return view('admin.sales.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        SaleProperty::create($data);

        return redirect()->route('admin.sales.index')->with('status', __('admin.flash.saved'));
    }

    public function edit(SaleProperty $sale)
    {
        return view('admin.sales.edit', ['property' => $sale]);
    }

    public function update(Request $request, SaleProperty $sale)
    {
        $data = $this->validateData($request, $sale->id);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $sale->update($data);

        return back()->with('status', __('admin.flash.saved'));
    }

    public function destroy(SaleProperty $sale)
    {
        $sale->delete();
        return redirect()->route('admin.sales.index')->with('status', __('admin.flash.deleted'));
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $uniqueSlugRule = 'unique:sale_properties,slug';
        if ($ignoreId) {
            $uniqueSlugRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            'location' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'integer', 'min:0'],
            'description_short' => ['nullable', 'string', 'max:500'],
            'description_long' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
