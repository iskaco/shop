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
    protected $fillable = ['name', 'parent_id', 'slug', 'icon', 'description', 'is_active', 'is_featured'];
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

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
        return $this->parent ? $this->parent?->name : __('resources.category.root');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
