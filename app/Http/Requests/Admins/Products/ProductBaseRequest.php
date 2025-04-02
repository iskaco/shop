<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

abstract class ProductBaseRequest extends AdminsAuthRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'array', Rule::unique('products')->where(function ($query) {
                $query->whereNull('deleted_at')->where('category_id', $this->category_id);
            })],
            'slug' => ['required', 'string', Rule::unique('products')->where(function ($query) {
                $query->whereNull('deleted_at');
            })],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'brand_id' => ['required', 'numeric', 'exists:brands,id'],
            'description' => ['array'],
            'short_description' => ['array'],
            'stock' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
            'description' => ['en' => $this->description_en, 'ar' => $this->description_ar],
            'short_description' => ['en' => $this->short_description_en, 'ar' => $this->short_description_ar],
            'category_id' => $this->category_id['id'],
            'brand_id' => $this->brand_id['id'],
        ]);
    }
}
