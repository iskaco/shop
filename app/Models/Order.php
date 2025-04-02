<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use Logable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'status',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'shipping_cost',
        'total',
        'payment_method',
        'shipping_address'
    ];

    protected $appends = ['user_name'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->HasMany(OrderItem::class);
    }

    public function getUserNameAttribute() {
        return $this->user?->name;
    }
}
