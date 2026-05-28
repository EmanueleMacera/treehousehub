<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SaleProperty;
use App\Models\SalePropertyMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SalePropertyController extends Controller
{
    public function index()
    {
        $properties = SaleProperty::query()->with(['media', 'category.type'])->orderBy('sort_order')->get();
        return view('admin.sales.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.sales.create', ['categories' => $this->categoryOptions()]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data = $this->prepareRichText($data);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $property = SaleProperty::create($data);
        $this->storeMedia($request, $property);

        return redirect()->route('admin.sales.index')->with('status', __('admin.flash.saved'));
    }

    public function edit(SaleProperty $sale)
    {
        $sale->load('media');
        return view('admin.sales.edit', [
            'property' => $sale,
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function update(Request $request, SaleProperty $sale)
    {
        $data = $this->validateData($request, $sale->id);
        $data = $this->prepareRichText($data, $sale);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $sale->update($data);
        $this->storeMedia($request, $sale);

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

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            'location' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'description_short' => ['nullable', 'string', 'max:500'],
            'description_long' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255'],
            'property_type' => ['nullable', 'string', 'max:50'],
            'status' => ['nullable', 'in:draft,publish,sold'],
            'negotiable' => ['nullable', 'boolean'],
            'orientation' => ['nullable', 'string', 'max:50'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'rooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            'surface_commercial' => ['nullable', 'numeric', 'min:0'],
            'surface_residential' => ['nullable', 'numeric', 'min:0'],
            'surface_balcony' => ['nullable', 'numeric', 'min:0'],
            'garden_surface' => ['nullable', 'numeric', 'min:0'],
            'surface_common_parts' => ['nullable', 'numeric', 'min:0'],
            'thousandths' => ['nullable', 'numeric', 'min:0'],
            'floor' => ['nullable', 'string', 'max:20'],
            'construction_year' => ['nullable', 'integer', 'min:1800', 'max:2100'],
            'energy_class' => ['nullable', 'string', 'max:10'],
            'condition' => ['nullable', 'string', 'max:50'],
            'balcony' => ['nullable', 'integer', 'min:0'],
            'parking_spaces' => ['nullable', 'integer', 'min:0'],
            'has_parking' => ['nullable', 'boolean'],
            'has_garage' => ['nullable', 'boolean'],
            'has_pool' => ['nullable', 'boolean'],
            'has_spa' => ['nullable', 'boolean'],
            'has_park' => ['nullable', 'boolean'],
            'other_amenities' => ['nullable', 'string'],
            'annual_fee' => ['nullable', 'numeric', 'min:0'],
            'monthly_expenses' => ['nullable', 'numeric', 'min:0'],
            'imu_tax' => ['nullable', 'numeric', 'min:0'],
            'contact_name' => ['nullable', 'string', 'max:100'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'nearby' => ['nullable', 'string'],
            'external_link' => ['nullable', 'url', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'thumbnail' => ['nullable', 'image', 'max:8192'],
            'photos.*' => ['nullable', 'image', 'max:8192'],
            'pdf_files_upload.*' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'videos_upload.*' => ['nullable', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo', 'max:51200'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        unset($data['thumbnail'], $data['photos'], $data['pdf_files_upload'], $data['videos_upload']);

        $data['status'] = $data['status'] ?? ($request->boolean('active') ? 'publish' : 'draft');
        $data['active'] = $data['status'] === 'publish';
        $data['negotiable'] = $request->boolean('negotiable');

        foreach (['has_parking', 'has_garage', 'has_pool', 'has_spa', 'has_park'] as $field) {
            $data[$field] = $request->boolean($field);
        }

        return $data;
    }

    private function prepareRichText(array $data, ?SaleProperty $property = null): array
    {
        if (!empty($data['description_long'])) {
            $data['description_long'] = $this->cleanRichText($data['description_long']);

            $translations = $property?->description_translations ?? [];
            $translations['it'] = $data['description_long'];
            $data['description_translations'] = $translations;
        }

        return $data;
    }

    private function cleanRichText(string $value): string
    {
        $allowedTags = '<p><br><strong><b><em><i><u><s><a><ul><ol><li><h2><h3><blockquote>';
        $clean = strip_tags($value, $allowedTags);
        $clean = preg_replace('/\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $clean) ?? $clean;
        $clean = preg_replace('/\s+href\s*=\s*("|\')?\s*javascript:[^"\'>\s]+("|\')?/i', '', $clean) ?? $clean;

        return $clean;
    }

    private function storeMedia(Request $request, SaleProperty $property): void
    {
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('item_media', 'public');

            SalePropertyMedia::query()->updateOrCreate(
                ['sale_property_id' => $property->id, 'type' => 'thumbnail'],
                ['path' => $path, 'sort_order' => 0]
            );
        }

        if ($request->hasFile('photos')) {
            $sortOrder = (int) $property->media()->max('sort_order');

            foreach ($request->file('photos') as $photo) {
                $sortOrder++;
                $property->media()->create([
                    'type' => 'photo',
                    'sort_order' => $sortOrder,
                    'path' => $photo->store('item_media', 'public'),
                ]);
            }
        }

        if ($request->hasFile('pdf_files_upload')) {
            $pdfs = $property->pdf_files ?? [];

            foreach ($request->file('pdf_files_upload') as $pdf) {
                $path = $pdf->store('item_pdfs', 'public');
                $pdfs[] = [
                    'uuid' => (string) Str::uuid(),
                    'path' => $path,
                    'original_name' => $pdf->getClientOriginalName(),
                    'size' => $pdf->getSize(),
                    'uploaded_at' => now()->toDateTimeString(),
                ];
            }

            $property->forceFill(['pdf_files' => $pdfs])->save();
        }

        if ($request->hasFile('videos_upload')) {
            $videos = $property->videos ?? [];

            foreach ($request->file('videos_upload') as $video) {
                $path = $video->store('item_videos', 'public');
                $videos[] = [
                    'uuid' => (string) Str::uuid(),
                    'path' => $path,
                    'original_name' => $video->getClientOriginalName(),
                    'size' => $video->getSize(),
                    'uploaded_at' => now()->toDateTimeString(),
                ];
            }

            $property->forceFill(['videos' => $videos])->save();
        }
    }

    private function categoryOptions()
    {
        return Category::query()
            ->with('type')
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Category $category) => $category->type?->name ?? 'Senza macro-categoria');
    }
}
