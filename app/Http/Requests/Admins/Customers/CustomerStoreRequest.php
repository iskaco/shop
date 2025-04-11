<?php

namespace App\Http\Requests\Admins\Customers;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'customers.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
