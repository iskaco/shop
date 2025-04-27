<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory, Logable;

    protected $fillable = [
        'order_id',
        // 'product_id',
        'product_variant_id',
        'quantity',
        'unit_price',
        'unit_cost',
        'options',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['product_name'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product_variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class)->withTrashed();
    }

    public function getProductNameAttribute()
    {
        return $this->product?->name;
    }
}
