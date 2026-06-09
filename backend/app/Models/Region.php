<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Region extends Model
{
    use HasTranslations;

    public $translatable = ['name', 'description', 'short_description'];

    protected $fillable = [
        'name', 'slug', 'description', 'short_description', 'hero_image',
        'best_season', 'difficulty', 'popular_treks', 'highlights',
        'meta_title', 'meta_description', 'sort_order', 'is_active'
    ];

    protected $casts = [
        'popular_treks' => 'array',
        'highlights' => 'array',
        'name' => 'array',
        'description' => 'array',
        'short_description' => 'array',
        'is_active' => 'boolean',
    ];

    public function treks()
    {
        return $this->hasMany(Trek::class);
    }
}
