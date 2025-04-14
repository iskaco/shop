<?php

namespace App\Models;

use App\Logable;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Vendor extends Model implements HasMedia
{
    use HasTranslations,InteractsWithMedia,Logable,SoftDeletes,TranslatableTrait;
    // Your model attributes and methods here

    protected $fillable = [
        'name',
        'slug',
        'address',
        'is_active',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public $translatable = ['name'];

    protected $appends = ['name_translated'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia('Vendor.Images');

        return $media;
    }

    public function getThumbnailAttribute()
    {
        $media = $this->getFirstMedia('Vendor.Thumbnails');

        return $media;
    }

    public function getBannerAttribute()
    {
        $media = $this->getFirstMedia('Vendor.Banners');

        return $media;
    }
}
