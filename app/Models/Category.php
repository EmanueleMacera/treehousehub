<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type_id',
        'status',
        'thumbnail',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class, 'type_id');
    }

    public function saleProperties(): HasMany
    {
        return $this->hasMany(SaleProperty::class, 'category_id');
    }

    public function thumbnailUrl(): ?string
    {
        return $this->thumbnail ? asset('storage/' . ltrim($this->thumbnail, '/')) : null;
    }
}
