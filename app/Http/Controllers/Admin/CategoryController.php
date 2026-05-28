<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryType;
use App\Models\CategoryTypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'type_id']);

        $types = CategoryType::query()
            ->withCount(['categories', 'saleProperties'])
            ->orderBy('name')
            ->get();

        $categories = Category::query()
            ->with('type')
            ->withCount('saleProperties')
            ->when($filters['search'] ?? null, fn ($query, $search) => $query->where('name', 'like', "%{$search}%"))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['type_id'] ?? null, fn ($query, $typeId) => $query->where('type_id', $typeId))
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        $stats = [
            'total_categories' => Category::count(),
            'total_types' => CategoryType::count(),
            'public_categories' => Category::where('status', 'public')->count(),
            'draft_categories' => Category::where('status', 'draft')->count(),
        ];

        return view('admin.categories.index', compact('categories', 'types', 'filters', 'stats'));
    }

    public function createCategory()
    {
        return view('admin.categories.category-form', [
            'category' => null,
            'types' => CategoryType::query()->orderBy('name')->get(),
        ]);
    }

    public function storeCategory(Request $request)
    {
        $data = $this->validateCategory($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('category_thumbnails', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('status', __('admin.flash.saved'));
    }

    public function editCategory(Category $category)
    {
        return view('admin.categories.category-form', [
            'category' => $category,
            'types' => CategoryType::query()->orderBy('name')->get(),
        ]);
    }

    public function updateCategory(Request $request, Category $category)
    {
        $data = $this->validateCategory($request, $category->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('category_thumbnails', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('status', __('admin.flash.saved'));
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', __('admin.flash.deleted'));
    }

    public function createType()
    {
        return view('admin.categories.type-form', ['type' => null]);
    }

    public function storeType(Request $request)
    {
        $data = $this->validateType($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $type = CategoryType::create($data);
        $this->storeTypeMedia($request, $type);

        return redirect()->route('admin.categories.index')->with('status', __('admin.flash.saved'));
    }

    public function editType(CategoryType $type)
    {
        $type->load('media');

        return view('admin.categories.type-form', compact('type'));
    }

    public function updateType(Request $request, CategoryType $type)
    {
        $data = $this->validateType($request, $type->id);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $type->update($data);
        $this->storeTypeMedia($request, $type);

        return redirect()->route('admin.categories.index')->with('status', __('admin.flash.saved'));
    }

    public function destroyType(CategoryType $type)
    {
        $type->delete();

        return redirect()->route('admin.categories.index')->with('status', __('admin.flash.deleted'));
    }

    public function destroyTypeMedia(CategoryTypeMedia $media)
    {
        $media->delete();

        return back()->with('status', __('admin.flash.deleted'));
    }

    private function validateCategory(Request $request, ?int $ignoreId = null): array
    {
        $uniqueSlugRule = 'unique:categories,slug';
        if ($ignoreId) {
            $uniqueSlugRule .= ',' . $ignoreId;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            'type_id' => ['nullable', 'exists:category_types,id'],
            'status' => ['required', 'in:public,draft'],
            'thumbnail' => ['nullable', 'image', 'max:8192'],
        ]);
    }

    private function validateType(Request $request, ?int $ignoreId = null): array
    {
        $uniqueSlugRule = 'unique:category_types,slug';
        if ($ignoreId) {
            $uniqueSlugRule .= ',' . $ignoreId;
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $uniqueSlugRule],
            'macrodescription.it' => ['nullable', 'string'],
            'macrodescription.en' => ['nullable', 'string'],
            'microdescription.it' => ['nullable', 'string'],
            'microdescription.en' => ['nullable', 'string'],
            'iniziativa_immobiliare' => ['nullable', 'string'],
            'stato_iniziativa' => ['nullable', 'string'],
            'progetto' => ['nullable', 'string'],
            'area_intervento' => ['nullable', 'string'],
            'superficie_edifici' => ['nullable', 'numeric', 'min:0'],
            'volume_edifici' => ['nullable', 'numeric', 'min:0'],
            'unita_immobiliari' => ['nullable', 'integer', 'min:0'],
            'box_posti_auto' => ['nullable', 'integer', 'min:0'],
            'tempi_concessioni' => ['nullable', 'string'],
            'tempi_acquisizione' => ['nullable', 'string'],
            'tempi_realizzazione' => ['nullable', 'string'],
            'promotori' => ['nullable', 'string'],
            'compagine_sociale' => ['nullable', 'string'],
            'amministratore_unico' => ['nullable', 'string'],
            'consiglieri_soci' => ['nullable', 'string'],
            'collaboratori' => ['nullable', 'string'],
            'gestione_generale_iniziativa' => ['nullable', 'string'],
            'consulente_vendite' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:8192'],
            'photos.*' => ['nullable', 'image', 'max:8192'],
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        unset($data['thumbnail'], $data['photos'], $data['pdf']);
        $data['macrodescription'] = array_filter($data['macrodescription'] ?? []);
        $data['microdescription'] = array_filter($data['microdescription'] ?? []);

        return $data;
    }

    private function storeTypeMedia(Request $request, CategoryType $type): void
    {
        if ($request->hasFile('thumbnail')) {
            CategoryTypeMedia::query()->updateOrCreate(
                ['category_type_id' => $type->id, 'type' => 'thumbnail'],
                ['path' => $request->file('thumbnail')->store('category_types', 'public'), 'sort_order' => 0]
            );
        }

        if ($request->hasFile('pdf')) {
            CategoryTypeMedia::query()->updateOrCreate(
                ['category_type_id' => $type->id, 'type' => 'pdf'],
                ['path' => $request->file('pdf')->store('category_type_pdfs', 'public'), 'sort_order' => 0]
            );
        }

        if ($request->hasFile('photos')) {
            $sortOrder = (int) $type->media()->max('sort_order');

            foreach ($request->file('photos') as $photo) {
                $sortOrder++;
                $type->media()->create([
                    'type' => 'photo',
                    'path' => $photo->store('category_types', 'public'),
                    'sort_order' => $sortOrder,
                ]);
            }
        }
    }
}
