<?php

namespace App\Models;

use App\Logable;
use App\Models\Scopes\ActiveScope;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Brand extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, Logable, SoftDeletes, TranslatableTrait;

    protected $fillable = ['name', 'slug', 'description', 'short_description', 'is_active', 'is_featured'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $translatable = ['name', 'short_description', 'description'];

    protected $appends = ['name_translated'];

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('Brand.Images');

        return $media;
    }

    public function getThumbnailAttribute()
    {
        $media = $this->getFirstMedia('Brand.Thumbnails');

        return $media;
    }

    public function getBannerAttribute()
    {
        $media = $this->getFirstMedia('Brand.Banners');

        return $media;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Your model attributes and methods here
}
