<?php

namespace App\Http\Requests\Web\Customers;

class CustomerUpdateImageRequest extends CustomerBaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_image' => ['nullable', 'mimes:jpg,png,jpeg', 'image', 'max:2024'],
        ];
    }
}
