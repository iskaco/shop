<?php

namespace App\Traits;

trait TranslatableTrait
{
    public function toFrontendArray(): array
    {
        $attributes = $this->toArray();

        foreach ($this->translatable as $field) {
            if (isset($attributes[$field]) && is_array($attributes[$field])) {
                foreach ($attributes[$field] as $locale => $value) {
                    $attributes["{$field}_{$locale}"] = $value;
                }
                unset($attributes[$field]); // Remove the original translatable field
            }
        }

        return $attributes;
    }
}
