<?php

namespace App\Http\Requests\Admins\Products;

class ProductStoreRequest extends ProductBaseRequest
{
    public function __construct()
    {
        $this->action = 'products.store';
    }
}
