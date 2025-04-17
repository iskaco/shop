<?php

namespace App\Http\Requests\Web\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerBaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (auth('customer')?->user()?->id === $this->id) {
            return true;
        }

        return false;
    }
}
