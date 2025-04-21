<?php

namespace App\Http\Requests\Admins\Attributes;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttributeBaseRequest extends AdminsAuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => ['required', Rule::unique('attributes')->ignore($this->id)],
            'slug' => ['required', Rule::unique('attributes')->ignore($this->id)],
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
