<?php

namespace App\Http\Requests\Admins\AttributeValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttributeValueBaseRequest extends AdminsAuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'attribute_id' => ['required', Rule::exists('attributes', 'id')],
            'value' => ['required', 'array', Rule::unique('attribute_values')->where(function ($query) {
                $query->where('attribute_id', $this->attribute_id);
            })->ignore($this->id)],
            'code' => ['nullable', Rule::unique('attribute_values')->where('attribute_id', $this->attribute_id)->ignore($this->id)],
            //
        ];
    }

    public function prepareForValidation()
    {
        $data = [
            'value_en' => $this->value_en,
            'value_ar' => $this->value_ar,
        ];

        $validator = Validator::make($data, [
            'value_en' => ['required', 'string', 'max:255'],
            'value_ar' => ['required', 'string', 'max:255'],
        ]);
        // dd($this->all());
        $validator->validate();
        $this->merge([
            'value' => ['en' => $this->value_en, 'ar' => $this->value_ar],
            'attribute_id' => $this->attribute_id ? $this->attribute_id['id'] : null,

        ]);
    }
}
