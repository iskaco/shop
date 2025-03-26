<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    // Your model attributes and methods here
    protected $fillable=['name','slug','description','is_active'];

    public $translatable=['name','description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
