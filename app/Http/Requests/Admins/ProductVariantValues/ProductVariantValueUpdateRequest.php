<?php

namespace App\Http\Requests\Admins\ProductVariantValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductVariantValueUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'productvariantvalues.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
