<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleProperty extends Model
{
    protected $fillable = [
        'title',
        'source_item_id',
        'slug',
        'location',
        'address',
        'orientation',
        'latitude',
        'longitude',
        'price',
        'description_short',
        'description_long',
        'description_translations',
        'bathrooms',
        'rooms',
        'surface_commercial',
        'surface_residential',
        'surface_balcony',
        'garden_surface',
        'surface_common_parts',
        'thousandths',
        'floor',
        'construction_year',
        'energy_class',
        'condition',
        'balcony',
        'has_parking',
        'has_garage',
        'has_pool',
        'has_spa',
        'has_park',
        'parking_spaces',
        'other_amenities',
        'annual_fee',
        'monthly_expenses',
        'imu_tax',
        'contact_name',
        'contact_phone',
        'pdf_files',
        'videos',
        'nearby',
        'external_link',
        'category_id',
        'status',
        'property_type',
        'negotiable',
        'active',
        'sort_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'integer',
        'sort_order' => 'integer',
        'description_translations' => 'array',
        'pdf_files' => 'array',
        'videos' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'surface_commercial' => 'decimal:2',
        'surface_residential' => 'decimal:2',
        'surface_balcony' => 'decimal:2',
        'garden_surface' => 'decimal:2',
        'surface_common_parts' => 'decimal:2',
        'thousandths' => 'decimal:2',
        'annual_fee' => 'decimal:2',
        'monthly_expenses' => 'decimal:2',
        'imu_tax' => 'decimal:2',
        'has_parking' => 'boolean',
        'has_garage' => 'boolean',
        'has_pool' => 'boolean',
        'has_spa' => 'boolean',
        'has_park' => 'boolean',
        'negotiable' => 'boolean',
    ];

    public function localizedDescription(?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();
        $translations = $this->description_translations ?? [];
        $value = $translations[$locale] ?? $translations['it'] ?? $translations['en'] ?? $this->description_long;

        return is_string($value) && trim($value) !== '' ? $value : null;
    }

    public function media(): HasMany
    {
        return $this->hasMany(SalePropertyMedia::class)->orderBy('sort_order')->orderBy('id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function photos(): HasMany
    {
        return $this->media()->whereIn('type', ['thumbnail', 'photo']);
    }

    public function thumbnail(): ?SalePropertyMedia
    {
        return $this->media
            ->firstWhere('type', 'thumbnail')
            ?? $this->media->first();
    }

    public function documentFiles(): array
    {
        return $this->normalizedFileList($this->pdf_files ?? []);
    }

    public function videoFiles(): array
    {
        return $this->normalizedFileList($this->videos ?? []);
    }

    public function summary(?string $locale = null): ?string
    {
        if ($this->description_short) {
            return $this->description_short;
        }

        $description = $this->localizedDescription($locale);
        if (!$description) {
            return null;
        }

        return str($description)->stripTags()->squish()->limit(180)->toString();
    }

    public function featureList(): array
    {
        return array_filter([
            'rooms' => $this->rooms,
            'bathrooms' => $this->bathrooms,
            'surface' => $this->surface_commercial,
            'floor' => $this->floor,
            'energy' => $this->energy_class,
        ], fn ($value) => $value !== null && $value !== '');
    }

    public function amenityList(): array
    {
        $amenities = [];

        if ($this->has_parking || $this->parking_spaces) {
            $amenities[] = 'Parcheggio';
        }
        if ($this->has_garage) {
            $amenities[] = 'Garage';
        }
        if ($this->has_pool) {
            $amenities[] = 'Piscina';
        }
        if ($this->has_spa) {
            $amenities[] = 'SPA';
        }
        if ($this->has_park) {
            $amenities[] = 'Parco';
        }
        if ($this->other_amenities) {
            $amenities = array_merge($amenities, array_filter(array_map('trim', preg_split('/[-,;]/', $this->other_amenities))));
        }

        return array_values(array_unique($amenities));
    }

    public function regionKey(): string
    {
        $haystack = mb_strtolower(implode(' ', array_filter([
            $this->location,
            $this->address,
            $this->title,
        ])));

        if (str_contains($haystack, 'limone') || str_contains($haystack, 'cuneo') || str_contains($haystack, 'borgo fantino')) {
            return 'piemonte';
        }

        return 'liguria';
    }

    public function regionLabel(): string
    {
        return match ($this->regionKey()) {
            'piemonte' => 'Piemonte',
            default => 'Liguria',
        };
    }

    private function normalizedFileList(array $files): array
    {
        return collect($files)
            ->map(function ($file) {
                if (is_string($file)) {
                    $file = ['path' => $file, 'original_name' => basename($file)];
                }

                if (!is_array($file) || empty($file['path'])) {
                    return null;
                }

                $path = ltrim((string) $file['path'], '/');
                $url = str_starts_with($path, 'http://') || str_starts_with($path, 'https://')
                    ? $path
                    : asset('storage/' . $path);

                return [
                    'url' => $url,
                    'name' => $file['original_name'] ?? basename($path),
                    'path' => $path,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }
}
