<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $fillable = [
        'title', 'seo_title', 'description', 'icon',
        'stats', 'bullets', 'sort_order', 'is_active'
    ];

    protected $casts = [
        'stats' => 'array',
        'bullets' => 'array',
        'is_active' => 'boolean',
    ];
}
