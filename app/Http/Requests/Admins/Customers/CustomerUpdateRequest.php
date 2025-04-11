<?php

namespace App\Http\Requests\Admins\Customers;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'customers.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
