<?php

namespace App\Http\Requests\Web\Customers;

use Illuminate\Support\Facades\Validator;

class CustomerStoreRequest extends CustomerBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            } else {
                $this->merge(['mobile' => $this->login_id]);
            }
        }
    }
}
