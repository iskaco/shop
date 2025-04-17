<?php

namespace App\Http\Requests\Web\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'name' => ['string', 'max:100', Rule::unique('customers')->whereNull('deleted_at')],
            'email' => ['nullable', 'string', 'email', 'max:100', Rule::unique('customers')->whereNull('deleted_at')],
            'mobile' => ['nullable', 'string', 'max:20', Rule::unique('customers')->whereNull('deleted_at')],
            // 'required' => ['required_without:mobile', 'required_without:email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ];
    }

    protected function prepareForValidation(): void
    {
        $data = [
            'login_id' => $this->login_id,
        ];

        $validator = Validator::make($data, [
            'login_id' => ['required', 'string', 'max:100'],
        ]);

        $validator->validate();

        if ($this->login_id) {
            if (filter_var($this->login_id, FILTER_VALIDATE_EMAIL)) {
                $this->merge(['email' => $this->login_id]);
            } elseif (preg_match('/^[0-9]{10,15}$/', $this->login_id)) {
                $this->merge(['mobile' => $this->login_id]);
            }

        }
    }
}
