<?php

namespace App\Http\Requests\Admins\OrderItems;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class OrderItemUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'orderitems.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
