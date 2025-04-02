<?php

namespace App\Http\Requests\Admins\Carts;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CartStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'carts.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
