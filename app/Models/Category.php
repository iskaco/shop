<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, Logable;

    // Your model attributes and methods here
    protected $fillable = ['name', 'parent_id', 'slug', 'icon', 'description', 'is_active'];

    public $translatable = ['name', 'description'];
    protected $appends = ['name_translated', 'parent_name'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    public function getParentNameAttribute()
    {
        return $this->parent?->name;
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
