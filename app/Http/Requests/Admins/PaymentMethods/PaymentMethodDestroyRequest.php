<?php

namespace App\Http\Requests\Admins\PaymentMethods;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class PaymentMethodDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'paymentmethods.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
