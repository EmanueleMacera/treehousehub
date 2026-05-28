<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CategoryType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'macrodescription',
        'microdescription',
        'iniziativa_immobiliare',
        'stato_iniziativa',
        'progetto',
        'area_intervento',
        'superficie_edifici',
        'volume_edifici',
        'unita_immobiliari',
        'box_posti_auto',
        'tempi_concessioni',
        'tempi_acquisizione',
        'tempi_realizzazione',
        'promotori',
        'compagine_sociale',
        'amministratore_unico',
        'consiglieri_soci',
        'collaboratori',
        'gestione_generale_iniziativa',
        'consulente_vendite',
    ];

    protected $casts = [
        'macrodescription' => 'array',
        'microdescription' => 'array',
        'superficie_edifici' => 'decimal:2',
        'volume_edifici' => 'decimal:2',
        'unita_immobiliari' => 'integer',
        'box_posti_auto' => 'integer',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'type_id')->orderBy('name');
    }

    public function saleProperties()
    {
        return $this->hasManyThrough(SaleProperty::class, Category::class, 'type_id', 'category_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(CategoryTypeMedia::class)->orderBy('sort_order')->orderBy('id');
    }

    public function thumbnail(): HasOne
    {
        return $this->hasOne(CategoryTypeMedia::class)->where('type', 'thumbnail');
    }

    public function photos(): HasMany
    {
        return $this->media()->where('type', 'photo');
    }

    public function pdf(): HasOne
    {
        return $this->hasOne(CategoryTypeMedia::class)->where('type', 'pdf');
    }

    public function localized(string $field, ?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();
        $translations = $this->{$field} ?? [];
        $value = is_array($translations) ? ($translations[$locale] ?? $translations['it'] ?? $translations['en'] ?? null) : null;

        return is_string($value) && trim($value) !== '' ? $value : null;
    }
}
