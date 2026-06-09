<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Peak extends Model
{
    use HasTranslations;

    public $translatable = [
        'name', 'short_description', 'description', 'tagline',
        'highlights', 'places', 'included', 'excluded', 'itinerary'
    ];

    protected $fillable = [
        'slug', 'duration', 'max_altitude', 'difficulty', 'best_season',
        'price', 'group_size', 'start_point', 'end_point', 'start_end',
        'is_featured', 'is_active', 'hero_image', 'icon', 'tag'
    ];

    protected $casts = [
        'highlights' => 'array',
        'places' => 'array',
        'included' => 'array',
        'excluded' => 'array',
        'itinerary' => 'array',
    ];
}