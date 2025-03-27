<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;

abstract class ProductBaseRequest extends AdminsAuthRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'description' => ['required', 'array'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:0'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
            'description' => ['en' => $this->description_en, 'ar' => $this->description_ar],
            'category_id' => $this->category_id['id'],
        ]);
    }
}
