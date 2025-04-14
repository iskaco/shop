<?php

namespace App\Http\Requests\Admins\Vendors;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VendorBaseRequest extends AdminsAuthRequest
{
    public function rules(): array
    {

        return [
            'name' => ['required', 'array', 'max:300', Rule::unique('vendors')->whereNull('deleted_at')->ignore($this->id)],
            'slug' => ['required', 'string', 'max:100', Rule::unique('vendors')->whereNull('deleted_at')->ignore($this->id)],
            'address' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'array'],
            'short_description' => ['required', 'array'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
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
            'name_en' => ['required', 'string', 'max:120'],
            'name_en' => ['required', 'string', 'max:120'],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'short_description_en' => ['nullable', 'string', 'max:800'],
            'short_description_ar' => ['nullable', 'string', 'max:800'],

        ]);

        $validator->validate();
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
            'description' => ['en' => $this->description_en, 'ar' => $this->description_ar],
            'short_description' => ['en' => $this->short_description_en, 'ar' => $this->short_description_ar],
        ]);
    }
}
