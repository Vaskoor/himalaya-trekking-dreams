<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HomepageSetting extends Model
{
    use HasTranslations;

    public $translatable = ['value'];

    protected $fillable = ['key', 'value', 'type'];

    protected $casts = [
        'value' => 'array',
        'type' => 'string',
    ];
}
