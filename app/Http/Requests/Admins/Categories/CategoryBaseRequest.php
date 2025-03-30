<?php

namespace App\Http\Requests\Admins\Categories;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

abstract class CategoryBaseRequest extends AdminsAuthRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'parent_id' => ['nullable', 'numeric', Rule::exists('categories', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'slug' => ['required', 'string', 'max:200', Rule::unique('categories')->ignore($this->category)],
            'description' => ['required', 'array'],
            'is_active' => ['nullable', 'boolean'],
            'icon' => ['nullable', 'string', 'max:100'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
            'description' => ['en' => $this->description_en, 'ar' => $this->description_ar],
            'parent_id' => $this->parent_id['id'],
        ]);
    }
}
