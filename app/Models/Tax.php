<?php

namespace App\Models;

use App\Logable;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tax extends Model
{
    use HasFactory, Logable, HasTranslations, TranslatableTrait;
    protected $fillable = ['name', 'rate', 'country_code', 'is_active'];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $translatable = ['name'];
    protected $appends = ['name_translated'];
    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

}
