<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselSlide extends Model
{
    protected $fillable = ['type', 'src', 'poster', 'alt', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}