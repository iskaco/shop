<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantValue extends Model
{
    // Your model attributes and methods here
    protected $fillable = ['product_variant_id', 'attribute_value_id'];

    public function attribute_value()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
