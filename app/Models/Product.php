<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;
    // Your model attributes and methods here
    protected $fillable = ['name','category_id', 'description', 'price', 'stock'];

    public $translatable = ['name','description'];

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

    public function getCategoryAttribute()
    {
        return $this->category->name;
    }


}
