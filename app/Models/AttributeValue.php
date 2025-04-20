<?php

namespace App\Models;

use App\Logable;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use Logable;
    // Your model attributes and methods here

    protected $fillable = ['attribute_id', 'value', 'code'];

    protected $appends = ['attribute_name'];

    public function getAttributeNameAttribute()
    {
        return $this?->attribute?->name;
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
