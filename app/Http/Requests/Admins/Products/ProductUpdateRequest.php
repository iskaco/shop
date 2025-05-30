<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends ProductBaseRequest
{
    public function __construct()
    {
        $this->action = 'products.update';
    }
}
