<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

        // Handle dynamic relationships
        foreach ($this->getRelations() as $relation => $related) {
            if ($this->relationLoaded($relation)) {
                if ($related instanceof Model) {
                    // Handle belongsTo relationship
                    $attributes["{$relation}_id"] = [
                        'id' => $related->id,
                        'name' => $related->name ?? null, // Adjust as needed for other attributes
                    ];
                    unset($attributes["$relation"]); // Remove the foreign key
                } elseif ($related instanceof Collection) {
                    // Handle hasMany relationship
                    $attributes[$relation] = $related->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name ?? null, // Adjust as needed for other attributes
                        ];
                    })->toArray();
                }
            }
        }

        return $attributes;
    }
}
