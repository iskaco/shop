<?php

namespace App\Http\Requests\Admins\ProductVariantValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductVariantValueStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'productvariantvalues.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
