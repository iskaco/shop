<?php

namespace App\Http\Requests\Admins\Orders;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class OrderDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'orders.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
