<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeasonalGuide extends Model
{
    protected $table = 'seasonal_guides';
    
    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'season', 'month_range', 'featured_image',
        'weather_summary', 'recommended_treks', 'recommended_activities', 'pros', 'cons',
        'author', 'published_at', 'is_active', 'meta_title', 'meta_description', 'sort_order'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];
}
