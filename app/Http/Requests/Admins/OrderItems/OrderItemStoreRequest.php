<?php

namespace App\Http\Requests\Admins\OrderItems;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class OrderItemStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'orderitems.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
