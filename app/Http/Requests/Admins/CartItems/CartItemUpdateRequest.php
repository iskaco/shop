<?php

namespace App\Http\Requests\Admins\CartItems;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CartItemUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'cartitems.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
