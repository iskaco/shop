<?php

namespace App\Http\Requests\Admins\Categories;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

abstract class CategoryBaseRequest extends AdminsAuthRequest
{
    public function rules(): array
    {

        return [
            'name' => ['required', 'array', Rule::unique('categories')->where(function ($query) {
                $query->where('deleted_at', null);
            })->ignore($this->id)],
            'parent_id' => ['nullable', 'numeric', Rule::exists('categories', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'slug' => ['required', 'string', 'max:200', Rule::unique('categories')->where(function ($query) {
                $query->where('deleted_at', null);
            })->ignore($this->id)],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'description' => ['nullable', 'array'],
            'short_description' => ['nullable', 'array'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'icon' => ['nullable', 'string', 'max:100'],
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
            'name' => [
                'en' => $this->name_en ?? '',
                'ar' => $this->name_ar ?? '',
            ],
            'description' => [
                'en' => $this->description_en ?? '',
                'ar' => $this->description_ar ?? '',
            ],
            'short_description' => [
                'en' => $this->short_description_en ?? '',
                'ar' => $this->short_description_ar ?? '',
            ],
            'parent_id' => $this->parent_id ? $this->parent_id['id'] : null,
        ]);
    }
}
