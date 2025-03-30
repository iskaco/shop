<?php

namespace App\Http\Requests\Admins\Orders;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'orders.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
