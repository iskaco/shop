<?php

namespace App\Http\Requests\Admins\CartItems;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CartItemStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'cartitems.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
