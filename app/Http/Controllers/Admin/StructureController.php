<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $data = $this->normalizeTranslations($data);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('structures', 'public');
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
        $data = $this->normalizeTranslations($data);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if ($request->hasFile('image')) {
            if ($structure->image_path) {
                Storage::disk('public')->delete($structure->image_path);
            }
            $data['image_path'] = $request->file('image')->store('structures', 'public');
        }

        if ($request->boolean('remove_image')) {
            if ($structure->image_path) {
                Storage::disk('public')->delete($structure->image_path);
            }
            $data['image_path'] = null;
        }

        $structure->update($data);

        return back()->with('status', __('admin.flash.saved'));
    }

    public function destroy(Structure $structure)
    {
        if ($structure->image_path) {
            Storage::disk('public')->delete($structure->image_path);
        }

        $structure->delete();
        return redirect()->route('admin.structures.index')->with('status', __('admin.flash.deleted'));
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        $uniqueSlugRule = 'unique:structures,slug';
        if ($ignoreId) {
            $uniqueSlugRule .= ',' . $ignoreId;
        }

        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'name_translations' => ['nullable', 'array'],
            'name_translations.it' => ['required', 'string', 'max:255'],
            'name_translations.en' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            'location' => ['nullable', 'string', 'max:255'],
            'location_translations' => ['nullable', 'array'],
            'location_translations.it' => ['nullable', 'string', 'max:255'],
            'location_translations.en' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'address_translations' => ['nullable', 'array'],
            'address_translations.it' => ['nullable', 'string', 'max:255'],
            'address_translations.en' => ['nullable', 'string', 'max:255'],
            'description_short' => ['nullable', 'string', 'max:500'],
            'description_short_translations' => ['nullable', 'array'],
            'description_short_translations.it' => ['nullable', 'string', 'max:500'],
            'description_short_translations.en' => ['nullable', 'string', 'max:500'],
            'description_long' => ['nullable', 'string'],
            'description_long_translations' => ['nullable', 'array'],
            'description_long_translations.it' => ['nullable', 'string'],
            'description_long_translations.en' => ['nullable', 'string'],
            'external_url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        unset($data['image'], $data['remove_image']);

        $data['active'] = $request->boolean('active');

        return $data;
    }

    private function normalizeTranslations(array $data): array
    {
        $locales = ['it', 'en'];
        $fields = ['name', 'location', 'address', 'description_short', 'description_long'];

        foreach ($fields as $field) {
            $translationKey = $field . '_translations';
            $translations = [];

            foreach ($locales as $locale) {
                $value = $data[$translationKey][$locale] ?? null;
                $value = is_string($value) ? trim($value) : null;

                if ($field === 'description_long' && $value) {
                    $value = $this->cleanRichText($value);
                }

                if ($value !== null && $value !== '' && $value !== '<p><br></p>') {
                    $translations[$locale] = $value;
                }
            }

            $data[$translationKey] = $translations ?: null;
        }

        $data['name'] = $data['name_translations']['it'] ?? $data['name'];
        $data['location'] = $data['location_translations']['it'] ?? $data['location'] ?? null;
        $data['address'] = $data['address_translations']['it'] ?? $data['address'] ?? null;
        $data['description_short'] = $data['description_short_translations']['it'] ?? $data['description_short'] ?? null;
        $data['description_long'] = $data['description_long_translations']['it'] ?? $data['description_long'] ?? null;

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
}
