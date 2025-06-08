<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PaymentMethod extends Model
{
    use HasTranslations;

    protected $table = 'PaymentMethods';

    protected $fillable = ['title_en', 'title_fa', 'description_en', 'description_fa', 'is_active'];

    protected $casts = [
            'is_active' => 'boolean'
        ];

    public $translatable = ['title', 'description'];

    protected $appends = ['title_translated', 'description_translated'];

    // Translation accessors
    public function gettitleTranslatedAttribute()
    {
        $locale = app()->getLocale();
        $fallbackLocale = config('app.fallback_locale');

        // Try to get the translation in the current locale
        $translation = $this->getTranslation('title', $locale);

        // If no translation exists in the current locale, try the fallback locale
        if (empty($translation)) {
            $translation = $this->getTranslation('title', $fallbackLocale);
        }

        return $translation;
    }

    public function getdescriptionTranslatedAttribute()
    {
        $locale = app()->getLocale();
        $fallbackLocale = config('app.fallback_locale');

        // Try to get the translation in the current locale
        $translation = $this->getTranslation('description', $locale);

        // If no translation exists in the current locale, try the fallback locale
        if (empty($translation)) {
            $translation = $this->getTranslation('description', $fallbackLocale);
        }

        return $translation;
    }

    // Your model attributes and methods here
}
