<?php

namespace App\Http\Requests\Admins\PaymentMethods;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class PaymentMethodStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'paymentmethods.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
