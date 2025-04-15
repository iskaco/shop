<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Customer extends User implements HasMedia
{
    use InteractsWithMedia, Logable;

    protected $fillable = ['name', 'email', 'password', 'mobile', 'enable', 'address', 'city', 'country', 'postal_code'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'enable' => 'boolean',
    ];

    // Set password hash
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    // Your model attributes and methods here

    public function getProfileImageAttribute()
    {
        $media = $this->getFirstMedia('Customer.Profile');

        return $media;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
