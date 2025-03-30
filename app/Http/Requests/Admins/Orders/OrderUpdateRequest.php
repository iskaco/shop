<?php

namespace App\Http\Requests\Admins\Orders;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class OrderUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'orders.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
