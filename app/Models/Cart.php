<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory, Logable;

    protected $fillable = [ 
        'user_id',
        'session_id',
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $appends = ['user_name'];


    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getUserNameAttribute() {
        return $this->user?->name ?? $this->session_id;
    }
}
