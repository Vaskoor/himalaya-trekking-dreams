<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Comparison extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'excerpt', 'content', 'verdict'];
    protected $fillable = [
        'slug', 'title', 'excerpt', 'content', 'featured_image',
        'item_a_type', 'item_a_id', 'item_b_type', 'item_b_id',
        'comparison_points', 'verdict', 'author', 'published_at',
        'is_active', 'meta_title', 'meta_description', 'sort_order'
    ];
    protected $casts = [
        'comparison_points' => 'array',
        'verdict' => 'array',
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
    public function itemA() {
        if (!$this->item_a_type || !$this->item_a_id) return null;
        $class = "App\\Models\\" . ucfirst($this->item_a_type);
        return class_exists($class) ? $class::find($this->item_a_id) : null;
    }
    public function itemB() {
        if (!$this->item_b_type || !$this->item_b_id) return null;
        $class = "App\\Models\\" . ucfirst($this->item_b_type);
        return class_exists($class) ? $class::find($this->item_b_id) : null;
    }
}
