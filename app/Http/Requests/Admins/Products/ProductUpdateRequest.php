<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'products.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
