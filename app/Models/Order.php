<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use Logable;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
