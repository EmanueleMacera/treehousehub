<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalePropertyMedia extends Model
{
    protected $table = 'sale_property_media';

    protected $fillable = [
        'sale_property_id',
        'source_media_id',
        'type',
        'sort_order',
        'path',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function saleProperty(): BelongsTo
    {
        return $this->belongsTo(SaleProperty::class);
    }

    public function url(): ?string
    {
        return $this->path ? asset('storage/' . ltrim($this->path, '/')) : null;
    }
}
