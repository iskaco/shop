<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasFactory, HasTranslations, TranslatableTrait, InteractsWithMedia, Logable, SoftDeletes;

    protected $fillable = ['name', 'parent_id', 'slug', 'icon', 'description', 'is_active', 'is_featured'];
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $translatable = ['name', 'description'];
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

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('Category.Images');

        return $media;
    }

    public function getThumbnailAttribute()
    {
        $media = $this->getFirstMedia('Category.Thumbnails');

        return $media;
    }

    public function getBannerAttribute()
    {
        $media = $this->getFirstMedia('Category.Banners');

        return $media;
    }
}
