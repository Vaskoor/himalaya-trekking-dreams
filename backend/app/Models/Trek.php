<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Trek extends Model
{
    use HasTranslations;

    public $translatable = [
        'name', 
        'short_description', 
        'description', 
        'meta_title', 
        'meta_description',
        'tagline'  // <-- Add this
    ];

    protected $fillable = [
        'slug', 'duration', 'max_altitude', 'difficulty', 'best_season',
        'price', 'discount_price', 'group_size', 'start_point', 'end_point',
        'start_end', 'is_featured', 'is_active', 'view_count', 'region_id'
    ];

    protected $casts = [
        'highlights' => 'array',
        'places' => 'array',
        'included' => 'array',
        'excluded' => 'array',
        'itinerary' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'is_top_destination' => 'boolean',
    ];

    public function region() { return $this->belongsTo(Region::class); }
    public function itineraries() { return $this->hasMany(Itinerary::class)->orderBy('day_number'); }
    public function bookings() { return $this->hasMany(Booking::class); }
    public function reviews() { return $this->hasMany(Review::class); }
}