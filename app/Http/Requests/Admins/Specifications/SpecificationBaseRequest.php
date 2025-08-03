<?php

namespace App\Http\Requests\Admins\Specifications;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Traits\HandlesTranslatableValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SpecificationBaseRequest extends AdminsAuthRequest
{

    use HandlesTranslatableValidation;

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
        $this->merge([
            'category_id' => $this->category_id ? $this->category_id['id'] : null,
        ]);
    }


}
