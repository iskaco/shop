<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    // Your model attributes and methods here
    protected $fillable = [
        'product_id',
        'sku',
        'price_factor',
        'stock',
        'stock_zone',
        'barcode',

    ];

    protected $casts = [
        'price_factor' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant_values()
    {
        return $this->hasMany(ProductVariantValue::class);
    }
}
