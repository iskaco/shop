<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, Logable;

    // Your model attributes and methods here
    protected $fillable = ['name', 'slug', 'category_id', 'brand_id', 'short_description', 'description', 'price', 'stock', 'is_published', 'is_featured'];
    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'stock' => 'integer',
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $translatable = ['name', 'short_description', 'description'];

    protected $appends = ['name_translated', 'category_name', 'brand_name'];

    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    public function getDescriptionTranslatedAttribute()
    {
        return $this->getTranslation('description', app()->getLocale());
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function getBrandNameAttribute()
    {
        return $this->brand?->name;
    }

    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('Products.Images');

        return $media;
    }
}
