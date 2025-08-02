<?php

namespace App\Http\Requests\Admins\Attributes;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Traits\HandlesTranslatableValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttributeBaseRequest extends AdminsAuthRequest
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
            //
            'name' => ['required', Rule::unique('attributes')->ignore($this->id)],
            'slug' => ['required', Rule::unique('attributes')->ignore($this->id)],
        ];
    }

    protected function translatableFieldsConfig(): array
    {
        return [
            'name' => [
                'rules' => ['string', 'max:255'],
                'required' => true,
            ],
        ];
    }
    public function prepareForValidation()
    {
        $this->prepareTranslatableValidation();
    }
}
