<?php

namespace App\Models;

use App\Logable;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasTranslations,Logable,TranslatableTrait;

    protected $fillable = [
        'name',
        'slug',
    ];

    public $translatable = ['name'];

    protected $appends = ['name_translated'];

    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());

    }
}
