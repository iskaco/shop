<?php

namespace App\Http\Requests\Admins\Brands;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class BrandBaseRequest extends AdminsAuthRequest
{


    public function rules(): array
    {
        return [
            'name' => ['required', 'array', Rule::unique('brands')->where(function ($query) {
                $query->where('deleted_at', null);
            })->ignore($this->brand)],
            'slug' => ['required', 'string', 'max:200', Rule::unique('brands')->where(function ($query) {
                $query->where('deleted_at', null);
            })->ignore($this->brand)],
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

        $validator = Validator::make($data,  [
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'short_description_en' => ['nullable', 'string'],
            'short_description_ar' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            $this->failedValidation($validator);
        }
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
            'description' => ['en' => $this->description_en, 'ar' => $this->description_ar],
            'short_description' => ['en' => $this->short_description_en, 'ar' => $this->short_description_ar],
        ]);
    }
}
