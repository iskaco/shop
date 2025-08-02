<?php

namespace App\Http\Requests\Admins\AttributeValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Traits\HandlesTranslatableValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttributeValueBaseRequest extends AdminsAuthRequest
{
    use HandlesTranslatableValidation;
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

    protected function translatableFieldsConfig(): array
    {
        return [
            'value' => [
                'rules' => ['string', 'max:255'],
                'required' => true,
            ],
        ];
    }
    public function prepareForValidation()
    {
        $this->prepareTranslatableValidation();
        $this->merge([
            'attribute_id' => $this->attribute_id ? $this->attribute_id['id'] : null,
        ]);
    }

}
