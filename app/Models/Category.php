<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements HasMedia
{
    use HasTranslations,InteractsWithMedia,Logable;

    // Your model attributes and methods here
    protected $fillable = ['name', 'slug', 'description', 'is_active'];

    public $translatable = ['name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
