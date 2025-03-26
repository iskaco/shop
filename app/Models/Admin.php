<?php

namespace App\Models;

use App\Collections\AdminCollection;
use App\Logable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements HasMedia
{
    use HasRoles, InteractsWithMedia, Logable;

    protected $fillable = ['email', 'password', 'mobile', 'first_name', 'last_name', 'enable', 'username'];

    protected $hidden = ['password', 'remember_token'];


    // Set password hash
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getProfileImageAttribute()
    {
        $media = $this->getFirstMedia('Admins.Profiles');

        return $media;
    }

}
