<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;

class ProductAttributesUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'products.attributes.update';
    }

    public function rules(): array
    {
        return [
            'attributes_id' => 'array',
        ];
    }

    public function prepareForValidation(): void
    {
        $attributes = [];
        foreach ($this->all() as $key => $items) {
            if (is_numeric($key) && $items !== null) {
                foreach ($items as $item) {
                    $attributes[] = ['attribute_id' => $key, 'value_id' => $item['id']];
                }
            }
        }

        $this->merge(['attributes_id' => $attributes]);
        // dd($this->attributes_id);
    }
}
