<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryTypeMedia extends Model
{
    protected $table = 'category_type_media';

    protected $fillable = [
        'category_type_id',
        'path',
        'type',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function categoryType(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class);
    }

    public function url(): string
    {
        return asset('storage/' . ltrim($this->path, '/'));
    }
}
