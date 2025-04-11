<?php

namespace App\Http\Requests\Web\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAuthenticateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login_id' => ['required', 'string', 'min:3', 'max:100', 'email', 'mobile'],
            'password' => ['required', 'string', 'min:6', 'max:15'],
        ];
    }
}
