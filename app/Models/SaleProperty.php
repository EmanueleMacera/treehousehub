<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProperty extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'location',
        'price',
        'description_short',
        'description_long',
        'active',
        'sort_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'integer',
        'sort_order' => 'integer',
    ];
}
