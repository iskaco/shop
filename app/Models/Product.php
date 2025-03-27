<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasTranslations,InteractsWithMedia,Logable;

    // Your model attributes and methods here
    protected $fillable = ['name', 'category_id', 'description', 'price', 'stock'];

    public $translatable = ['name', 'description'];

    protected $appends = ['name_translated', 'description_translated', 'category_name'];

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

    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('Products.Images');

        return $media;
    }
}
