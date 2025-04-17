<?php

namespace App\Http\Requests\Web\Customers;

use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends CustomerBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['string', 'max:100', Rule::unique('customers')->whereNull('deleted_at')->ignore($this->id)],
            'email' => auth('customer')?->user()?->login_type === 'mobile' ? [] : ['nullable', 'string', 'email', 'max:100', Rule::unique('customers')->whereNull('deleted_at')->ignore($this->id)],
            'mobile' => auth('customer')?->user()?->login_type === 'email' ? [] : ['nullable', 'string', 'max:20', Rule::unique('customers')->whereNull('deleted_at')->ignore($this->id)],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
        ];

    }

    public function prepareForValidation()
    {
        $this->merge([
            'id' => auth('customer')?->user()?->id,
        ]);
    }
}
