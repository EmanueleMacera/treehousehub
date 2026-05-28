<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = [
        'name',
        'name_translations',
        'slug',
        'location',
        'location_translations',
        'address',
        'address_translations',
        'description_short',
        'description_short_translations',
        'description_long',
        'description_long_translations',
        'external_url',
        'image_path',
        'active',
        'sort_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort_order' => 'integer',
        'name_translations' => 'array',
        'location_translations' => 'array',
        'address_translations' => 'array',
        'description_short_translations' => 'array',
        'description_long_translations' => 'array',
    ];

    public function localized(string $field, ?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();
        $translations = $this->{$field . '_translations'} ?? [];
        $value = $translations[$locale] ?? $translations['it'] ?? $this->{$field} ?? null;

        return is_string($value) && trim($value) !== '' ? $value : null;
    }
}
