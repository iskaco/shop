<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Rules\SlugRule;
use App\Traits\HandlesTranslatableValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

abstract class ProductBaseRequest extends AdminsAuthRequest
{
    use HandlesTranslatableValidation;

    public function rules(): array
    {
        return [
            'name' => ['required', 'array', Rule::unique('products')->where(function ($query) {
                $query->whereNull('deleted_at')->where('category_id', $this->category_id);
            })->ignore($this->id)],
            'slug' => ['required', 'string', new SlugRule, Rule::unique('products')->where(function ($query) {
                $query->whereNull('deleted_at');
            })->ignore($this->id)],
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'brand_id' => ['required', 'numeric', Rule::exists('brands', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'vendor_id' => ['nullable', 'numeric', Rule::exists('vendors', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'description' => ['array'],
            'short_description' => ['array'],
            'stock' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999999999'],
            'cost' => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
            'attributes_id' => ['nullable', 'array'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gallery' => ['nullable', 'array', 'max:5'],
            'gallery.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // max file size in KB
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
        ];

    }

    protected function translatableFieldsConfig(): array
    {
        return [
            'name' => [
                'rules' => ['string', 'max:255'],
                'required' => true,
            ],
            'description' => [
                'rules' => ['string'],
                'required' => false,
            ],
            'short_description' => [
                'rules' => ['string'],
                'required' => false,
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->prepareTranslatableValidation();
        $this->merge([
            'category_id' => $this->category_id ? $this->category_id['id'] : null,
            'brand_id' => $this->brand_id ? $this->brand_id['id'] : null,
            'vendor_id' => $this->vendor_id ? $this->vendor_id['id'] : null,
            'attributes_id' => collect($this->attributes_id)->pluck('id')->toArray(),
        ]);
    }
}
