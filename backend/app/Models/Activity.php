<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Activity extends Model
{
    use HasTranslations;
    public $translatable = ['name', 'short_description', 'description', 'highlights', 'included', 'excluded'];
    protected $fillable = ['slug','duration','price','difficulty','group_size','best_season','is_active','hero_image','icon','tag','sort_order','is_featured','is_popular','is_top_destination','section_priority'];
    protected $casts = [
        'name' => 'array',
            'short_description' => 'array',
            'description' => 'array',
            'highlights' => 'array',
            'included' => 'array',
            'excluded' => 'array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
}
