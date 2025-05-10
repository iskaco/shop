<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait HandlesTranslatableValidation
{
    /**
     * Get configuration for translatable fields
     */
    abstract protected function translatableFieldsConfig(): array;

    /**
     * Get non-translatable validation rules
     */
    protected function nonTranslatableRules(): array
    {
        return [];
    }

    /**
     * Get additional fields to merge after validation
     */
    protected function fieldsToMerge(): array
    {
        return [];
    }

    /**
     * Prepare for validation
     */
    protected function prepareTranslatableValidation()
    {
        $locales = config('app.available_locales', ['en']);
        $translatableFields = $this->translatableFieldsConfig();

        // Prepare data and rules
        $data = [];
        $rules = [];

        foreach ($translatableFields as $field => $config) {
            foreach ($locales as $locale) {
                $fieldName = "{$field}_{$locale}";
                $data[$fieldName] = $this->$fieldName ?? null;

                $rules[$fieldName] = $config['rules'] ?? [];
                if ($config['required'] ?? false) {
                    array_unshift($rules[$fieldName], 'required');
                }
            }
        }

        // Merge with non-translatable rules
        $rules = array_merge($rules, $this->nonTranslatableRules());

        // Validate
        Validator::make($data, $rules)->validate();

        // Prepare merged data
        $merged = [];

        foreach ($translatableFields as $field => $config) {
            $merged[$field] = [];
            foreach ($locales as $locale) {
                $merged[$field][$locale] = $this->{"{$field}_{$locale}"};
            }
        }

        $this->merge(array_merge($merged, $this->fieldsToMerge()));
    }
}
