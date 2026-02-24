<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'location',
        'address',
        'description_short',
        'description_long',
        'external_url',
        'image_path',
        'active',
        'sort_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
