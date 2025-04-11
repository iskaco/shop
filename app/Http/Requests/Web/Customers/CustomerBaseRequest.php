<?php

namespace App\Http\Requests\Web\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerBaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('customers')->whereNull('deleted_at')->ignore($this->id)],
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('customers')->whereNull('deleted_at')->ignore($this->id)],
            'mobile' => ['required', 'string', 'max:20', Rule::unique('customers')->whereNull('deleted_at')->ignore($this->id)],
            'password' => ['required', 'string', 'min:8'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'enable' => ['boolean'],
            'profile_image' => ['nullable', 'mimes:jpg,png,jpeg', 'image', 'max:2024'],
        ];
    }
}
