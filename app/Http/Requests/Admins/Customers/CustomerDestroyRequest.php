<?php

namespace App\Http\Requests\Admins\Customers;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CustomerDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'customers.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
