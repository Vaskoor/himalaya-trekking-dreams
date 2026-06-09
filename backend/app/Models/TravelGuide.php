<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TravelGuide extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'excerpt', 'content'];

    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'category', 'featured_image',
        'tags', 'author', 'published_at', 'is_active',
        'meta_title', 'meta_description', 'sort_order'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
