<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'products.store';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'json', 'max:300'],
            'description' => ['required', 'json', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'name' => json_encode(['en' => $this->name_en, 'ar' => $this->name_ar]),
            'description' => json_encode(['en' => $this->description_en, 'ar' => $this->description_ar]),
        ]);
    }
}
