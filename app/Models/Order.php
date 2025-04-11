<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, Logable, SoftDeletes;

    public const STATUSES = ['pending', 'paid', 'shipped', 'cancelled'];

    protected $fillable = [
        'customer_id',
        'status',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'shipping_cost',
        'total',
        'payment_method',
        'shipping_address',
    ];

    protected $appends = ['customer_name'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->HasMany(OrderItem::class);
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer?->name ?? ($this->customer?->email ?? $this->customer?->mobile);
    }
}
