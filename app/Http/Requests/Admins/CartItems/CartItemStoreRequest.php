<?php

namespace App\Http\Requests\Admins\CartItems;

use App\Http\Requests\Admins\AdminsAuthRequest;

class CartItemStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'cartitems.store';
    }

    public function rules(): array
    {

        return [
            'items' => ['array', 'required'],
        ];
    }
}
