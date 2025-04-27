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
use stdClass;

class Product extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, Logable, SoftDeletes, TranslatableTrait;

    // Your model attributes and methods here
    protected $fillable = ['name', 'slug', 'category_id', 'brand_id', 'vendor_id', 'short_description', 'description', 'price', 'cost', 'stock', 'is_published', 'is_featured'];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'stock' => 'integer',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $translatable = ['name', 'short_description', 'description'];

    protected $appends = ['name_translated', 'category_name', 'brand_name', 'vendor_name'];

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

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getBrandNameAttribute()
    {
        return $this->brand?->name;
    }

    public function getVendorNameAttribute()
    {
        return $this->vendor?->name;
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

    public function getGalleryAttribute()
    {
        return $this->getMedia('Product.Galleries');
    }

    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'product_specifications')
            ->withPivot('value');
    }

    public function attributes_id()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function getAttributeListAttribute()
    {
        $attribute_list = new stdClass;
        $attribute_list->id = $this?->id;
        $attribute_value_stack = [];
        foreach ($this?->variants as $vriant) {
            foreach ($vriant->variant_values as $variant_value) {
                if (! in_array($variant_value?->attribute_value?->id, $attribute_value_stack)) {
                    $attribute_list->{$variant_value?->attribute_value?->attribute?->name}[] = ['id' => $variant_value?->attribute_value?->id, 'name' => $variant_value?->attribute_value?->value];
                    array_push($attribute_value_stack, $variant_value?->attribute_value?->id);
                }
            }
        }

        return $attribute_list;
    }
}
