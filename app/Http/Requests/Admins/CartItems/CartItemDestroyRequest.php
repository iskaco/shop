<?php

namespace App\Http\Requests\Admins\CartItems;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CartItemDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'cartitems.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
