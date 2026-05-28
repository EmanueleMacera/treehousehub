<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CategoryType;
use App\Models\SaleProperty;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $region = $request->query('region');
        $category = $request->query('category');
        $macro = $request->query('macro');

        $properties = SaleProperty::query()
            ->with(['media', 'category.type'])
            ->where('active', true)
            ->where('status', 'publish')
            ->when($category, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->when($macro, fn ($query, $macroId) => $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('type_id', $macroId)))
            ->orderBy('sort_order')
            ->get()
            ->when(in_array($region, ['liguria', 'piemonte'], true), function ($collection) use ($region) {
                return $collection->filter(fn (SaleProperty $property) => $property->regionKey() === $region)->values();
            });

        $regionCounts = SaleProperty::query()
            ->where('active', true)
            ->where('status', 'publish')
            ->get()
            ->groupBy(fn (SaleProperty $property) => $property->regionKey())
            ->map->count();

        $categoryTypes = CategoryType::query()
            ->with(['categories' => fn ($query) => $query->where('status', 'public')->orderBy('name')])
            ->withCount('saleProperties')
            ->orderBy('name')
            ->get()
            ->filter(fn (CategoryType $type) => $type->sale_properties_count > 0 || $type->categories->isNotEmpty())
            ->values();

        return view('public.sales.index', compact('properties', 'region', 'regionCounts', 'categoryTypes', 'category', 'macro'));
    }

    public function show(string $slug)
    {
        $property = SaleProperty::query()
            ->with(['media', 'category.type'])
            ->where('active', true)
            ->where('status', 'publish')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.sales.show', compact('property'));
    }
}
