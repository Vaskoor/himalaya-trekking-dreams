<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'excerpt', 'content'];

    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'featured_image',
        'category', 'tags', 'author', 'published_at', 'is_active',
        'meta_title', 'meta_description', 'sort_order'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
