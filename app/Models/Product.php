<?php

namespace App\Models;

use App\Logable;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, Logable, SoftDeletes, TranslatableTrait;

    // Your model attributes and methods here
    protected $fillable = ['name', 'slug', 'category_id', 'brand_id', 'short_description', 'description', 'price', 'cost', 'stock', 'is_published', 'is_featured'];

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

    public function getCostAttribute($value)
    {
        return $value / 100;
    }

    public function setCostAttribute($value)
    {
        $this->attributes['cost'] = $value * 100;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
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
        $media = $this->getFirstMedia('Product.Images');

        return $media;
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'product_specifications')
            ->withPivot('value');
    }
}
