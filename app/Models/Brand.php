<?php

namespace App\Models;

use App\Logable;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Brand extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, Logable, TranslatableTrait;

    protected $fillable = ['name', 'slug', 'description', 'short_description', 'is_active', 'is_featured'];
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public $translatable = ['name', 'short_description', 'description'];
    protected $appends = ['name_translated'];
    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    // Your model attributes and methods here
}
