<?php

namespace App\Models;

use App\Logable;
use App\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Specification extends Model
{
    use SoftDeletes, HasTranslations, TranslatableTrait, Logable;
    // Your model attributes and methods here
    protected $translatable = ['name'];
    protected $fillable = [
        'name',
        'category_id',
        'input_type',
        'possible_values',
    ];
    protected $casts = [
        'possible_values' => 'array',
    ];

    protected $appends = ['name_translated', 'category_name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function getNameTranslatedAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }
    public function getCategoryNameAttribute()
    {
        return $this->category?->name;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_specifications')
            ->withPivot('value');
    }

    public function setPossibleValuesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['possible_values'] = json_encode($value);
        } else {
            $this->attributes['possible_values'] = $value;
        }
    }

    public function getPossibleValuesAttribute($value)
    {
        return json_decode($value, true);
    }
}
