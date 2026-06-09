<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TourPackage extends Model
{
    use HasTranslations;

    public $translatable = [
        'name', 'short_description', 'description', 'highlights', 'included', 'excluded'
    ];

    protected $fillable = [
        'slug', 'duration', 'price', 'difficulty', 'group_size',
        'best_season', 'hero_image', 'is_active', 'icon', 'tag'
    ];

    protected $casts = [
        'highlights' => 'array',
        'included' => 'array',
        'excluded' => 'array',
    ];
}