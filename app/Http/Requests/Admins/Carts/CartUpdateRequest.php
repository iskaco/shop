<?php

namespace App\Http\Requests\Admins\Carts;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CartUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'carts.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
