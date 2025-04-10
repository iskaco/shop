<?php

namespace App\Http\Requests\Admins\Taxes;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Http\Requests\Admins\Products\TaxBaseRequest;
use Illuminate\Validation\Rule;

class TaxStoreRequest extends TaxBaseRequest
{
    public function __construct()
    {
        $this->action = 'taxes.store';
    }
}
