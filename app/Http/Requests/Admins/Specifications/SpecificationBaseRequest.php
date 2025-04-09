<?php

namespace App\Http\Requests\Admins\Specifications;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SpecificationBaseRequest extends AdminsAuthRequest
{

    public function rules(): array
    {
        //dd($this->all());
        return [
            'name' => [
                'required',
                'array',
                Rule::unique('specifications')->where(function ($query) {
                    $query->whereNull('deleted_at')->where('category_id', $this->category_id);
                })->ignore($this->id),
            ],
            'category_id' => ['required', 'numeric', Rule::exists('categories', 'id')->where(function ($query) {
                $query->where('is_active', 1);
            })],
            'input_type' => [
                'required',
                Rule::in(['text', 'number', 'select']),
            ],
            'possible_values' => [
                'nullable',
                'array',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $data = [
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
        ];

        $validator = Validator::make($data, [
            'name_en' => ['required', 'string', 'max:100'],
            'name_ar' => ['required', 'string', 'max:100'],
        ]);
        $validator->validate();
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
            'category_id' => $this->category_id ? $this->category_id['id'] : null,
        ]);
    }
}
