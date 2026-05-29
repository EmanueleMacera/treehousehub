<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

        $allPublishedProperties = SaleProperty::query()
            ->with(['media', 'category.type'])
            ->where('active', true)
            ->where('status', 'publish')
            ->orderBy('sort_order')
            ->get();

        $regionCounts = $allPublishedProperties
            ->groupBy(fn (SaleProperty $property) => $property->regionKey())
            ->map->count();

        $categoryTypes = CategoryType::query()
            ->with([
                'thumbnail',
                'categories' => fn ($query) => $query
                    ->where('status', 'public')
                    ->withCount(['saleProperties' => fn ($propertyQuery) => $propertyQuery
                        ->where('sale_properties.active', true)
                        ->where('sale_properties.status', 'publish')])
                    ->orderBy('name'),
            ])
            ->withCount(['saleProperties' => fn ($query) => $query
                ->where('sale_properties.active', true)
                ->where('sale_properties.status', 'publish')])
            ->orderBy('name')
            ->get()
            ->filter(fn (CategoryType $type) => $type->sale_properties_count > 0 || $type->categories->isNotEmpty())
            ->values();

        $selectedCategory = $category
            ? Category::query()->with('type')->where('status', 'public')->find($category)
            : null;

        $selectedMacro = $macro
            ? $categoryTypes->firstWhere('id', (int) $macro)
            : null;

        $categoryGroups = $categoryTypes
            ->map(function (CategoryType $type) use ($allPublishedProperties, $region) {
                $typePropertyIds = $allPublishedProperties
                    ->filter(fn (SaleProperty $property) => $property->category?->type_id === $type->id)
                    ->when(in_array($region, ['liguria', 'piemonte'], true), fn ($items) => $items->filter(fn (SaleProperty $property) => $property->regionKey() === $region))
                    ->values();

                $categories = $type->categories
                    ->map(function (Category $category) use ($typePropertyIds) {
                        $categoryProperties = $typePropertyIds->where('category_id', $category->id)->values();
                        $category->visible_sale_properties_count = $categoryProperties->count();
                        $category->previewProperty = $categoryProperties->first();

                        return $category;
                    })
                    ->filter(fn (Category $category) => $category->visible_sale_properties_count > 0)
                    ->values();

                $type->visible_sale_properties_count = $typePropertyIds->count();
                $type->previewProperty = $typePropertyIds->first();
                $type->setRelation('visibleCategories', $categories);

                return $type;
            })
            ->filter(fn (CategoryType $type) => $type->visible_sale_properties_count > 0 || $type->visibleCategories->isNotEmpty())
            ->values();

        $showProperties = (bool) ($selectedCategory || $selectedMacro);

        return view('public.sales.index', compact(
            'properties',
            'region',
            'regionCounts',
            'categoryTypes',
            'categoryGroups',
            'category',
            'macro',
            'selectedCategory',
            'selectedMacro',
            'showProperties'
        ));
    }

    public function show(string $slug)
    {
        $slug = trim(urldecode($slug), '/');
        $property = null;

        if (preg_match('/^(\d+)(?:-|$)/', $slug, $matches)) {
            $property = SaleProperty::query()
                ->with(['media', 'category.type'])
                ->where('active', true)
                ->where('status', 'publish')
                ->where(function ($query) use ($matches) {
                    $query
                        ->whereKey((int) $matches[1])
                        ->orWhere('source_item_id', (int) $matches[1]);
                })
                ->first();

            if ($property) {
                return view('public.sales.show', compact('property'));
            }
        }

        if (!$property) {
            $property = $this->findPropertyBySlug($slug);
        }

        abort_unless($property, 404);

        return view('public.sales.show', compact('property'));
    }

    public function showById(string $sale)
    {
        $saleId = (int) $sale;

        $property = SaleProperty::query()
            ->with(['media', 'category.type'])
            ->where('active', true)
            ->where('status', 'publish')
            ->whereKey($saleId)
            ->first();

        if (!$property) {
            $property = SaleProperty::query()
                ->with(['media', 'category.type'])
                ->where('active', true)
                ->where('status', 'publish')
                ->where('source_item_id', $saleId)
                ->first();
        }

        abort_unless($property, 404);

        return view('public.sales.show', compact('property'));
    }

    private function findPropertyBySlug(string $slug): ?SaleProperty
    {
        $slug = trim(urldecode($slug), '/');
        $slugCandidates = array_values(array_unique(array_filter([
            $slug,
            '/' . $slug,
            basename($slug),
            preg_replace('/^\d+-/', '', $slug),
            '/' . preg_replace('/^\d+-/', '', $slug),
        ])));

        $property = SaleProperty::query()
            ->with(['media', 'category.type'])
            ->where('active', true)
            ->where('status', 'publish')
            ->whereIn('slug', $slugCandidates)
            ->first();

        return $property ?: $this->findPropertyByLooseSlug($slug);
    }

    private function findPropertyByLooseSlug(string $slug): ?SaleProperty
    {
        $target = $this->normalizePropertyKey($slug);

        if ($target === '') {
            return null;
        }

        return SaleProperty::query()
            ->with(['media', 'category.type'])
            ->where('active', true)
            ->where('status', 'publish')
            ->orderBy('sort_order')
            ->get()
            ->first(function (SaleProperty $property) use ($target) {
                $keys = [
                    $property->slug,
                    preg_replace('/^\d+-/', '', (string) $property->slug),
                    $property->title,
                    $property->publicRouteKey(),
                ];

                foreach ($keys as $key) {
                    if ($this->normalizePropertyKey((string) $key) === $target) {
                        return true;
                    }
                }

                return false;
            });
    }

    private function normalizePropertyKey(string $value): string
    {
        $value = trim(urldecode($value), '/');
        $value = preg_replace('/^\d+-/', '', $value) ?? $value;
        $value = strtolower($value);

        return preg_replace('/[^a-z0-9]+/', '', $value) ?? '';
    }
}
