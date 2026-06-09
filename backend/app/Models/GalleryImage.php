<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'image_path', 'title', 'location', 'description',
        'sort_order', 'is_active'
    ];
}
