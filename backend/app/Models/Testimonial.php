<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'author_name', 'author_country', 'platform', 'rating',
        'title', 'comment', 'trek_name', 'date',
        'is_approved', 'is_featured', 'sort_order'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'date' => 'date',
    ];
}
