<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    // Your model attributes and methods here
    protected $fillable = [
        'name',
        'category_id',
        'input_type',
        'possible_values',
    ];
    protected $casts = [
        'possible_values' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_specifications')
            ->withPivot('value');
    }
}
