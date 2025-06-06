<?php

namespace App\Http\Requests\Web\Customers;

class CustomerStoreCartRequest extends CustomerBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'cart_items' => ['array'],
        ];
    }
}
