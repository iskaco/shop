<?php

namespace App\Http\Requests\Admins\OrderItems;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class OrderItemDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'orderitems.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
