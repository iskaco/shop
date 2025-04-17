<?php

namespace App\Http\Requests\Web\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerBaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (auth('customer')?->check()) {
            return true;
        }

        return false;
    }
}
