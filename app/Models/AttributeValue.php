<?php

namespace App\Models;

use App\Logable;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasTranslations, Logable, TranslatableTrait;
    // Your model attributes and methods here

    protected $fillable = ['attribute_id', 'value', 'code'];

    protected $appends = ['attribute_name', 'value_translated'];

    protected $translatable = ['value'];

    public function getValueTranslatedAttribute()
    {
        return $this->getTranslation('value', app()->getLocale());
    }

    public function getAttributeNameAttribute()
    {
        return $this?->attribute?->name;
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
