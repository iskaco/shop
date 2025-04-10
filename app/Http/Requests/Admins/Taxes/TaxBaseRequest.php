<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

abstract class TaxBaseRequest extends AdminsAuthRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'array', Rule::unique('taxes')->where(function ($query) {
                $query->whereNull('deleted_at');
            })->ignore($this->product)],
            'rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'country_code' => ['nullable', 'in:LBN,EN'],
            'is_active' => ['nullable', 'boolean']
        ];
    }

    public function prepareForValidation()
    {
        $data = [
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
        ];

        $validator = Validator::make($data, [
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
        ]);

        $validator->validate();
        $this->merge([
            'name' => ['en' => $this->name_en, 'ar' => $this->name_ar],
        ]);
    }
}
