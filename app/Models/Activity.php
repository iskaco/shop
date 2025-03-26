<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Activity extends Model
{
    use HasTranslations;
    public $translatable = ['title', 'description'];

    protected $fillable = [
        'uri',
        'method',
        'action',
        'middleware',
        'title',
        'description',
        'permission_id',
        'is_menu',
        'icon_name',
        'parent_id',
        'is_active',
    ];

    protected function middleware(): Attribute
    {
        return Attribute::make(
            set: fn(array $value) => json_encode($value)
        );
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query): void
    {
        $query->where('is_active', false);
    }

    public function scopeIsMenu(Builder $query): void
    {
        $query->where('is_menu', true);
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }
}
