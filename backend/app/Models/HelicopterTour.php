<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HelicopterTour extends Model
{
    use HasTranslations;

    public $translatable = [
        'name', 'short_description', 'description', 'narrative',
        'safety_profile', 'highlights', 'stats', 'places', 'itinerary'
    ];

    protected $fillable = [
        'slug', 'duration', 'subtitle', 'altitude', 'badge', 'price',
        'group_size', 'best_season', 'hero_image', 'is_active'
    ];

    protected $casts = [
        'highlights' => 'array',
        'stats' => 'array',
        'places' => 'array',
        'itinerary' => 'array',
    ];
}