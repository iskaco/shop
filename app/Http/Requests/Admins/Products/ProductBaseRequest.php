<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

abstract class ProductBaseRequest extends AdminsAuthRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'array', Rule::unique('products')->where(function ($query) {
                $query->whereNull('deleted_at')->where('category_id', $this->category_id);
            })->ignore($this->id)],
            'slug' => ['required', 'string', Rule::unique('products')->where(function ($query) {
                $query->whereNull('deleted_at');
            })->ignore($this->id)],
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'brand_id' => ['required', 'numeric', Rule::exists('brands', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'vendor_id' => ['required', 'numeric', Rule::exists('vendors', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'description' => ['array'],
            'short_description' => ['array'],
            'stock' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost' => ['required', 'numeric', 'min:0'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gallery' => ['nullable', 'array', 'max:5'],
            'gallery.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // max file size in KB
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
        ];
    }

    public function prepareForValidation()
    {
        $data = [
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'short_description_en' => $this->short_description_en,
            'short_description_ar' => $this->short_description_ar,
        ];

        $validator = Validator::make($data, [
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'short_description_en' => ['nullable', 'string'],
            'short_description_ar' => ['nullable', 'string'],
        ]);

        $validator->validate();
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
            'description' => ['en' => $this->description_en, 'ar' => $this->description_ar],
            'short_description' => ['en' => $this->short_description_en, 'ar' => $this->short_description_ar],
            'category_id' => $this->category_id ? $this->category_id['id'] : null,
            'brand_id' => $this->brand_id ? $this->brand_id['id'] : null,
            'vendor_id' => $this->vendor_id ? $this->vendor_id['id'] : null,

        ]);
    }
}
