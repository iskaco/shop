<?php

namespace App\Http\Requests\Admins\Carts;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CartDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'carts.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
