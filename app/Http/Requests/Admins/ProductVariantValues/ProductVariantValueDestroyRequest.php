<?php

namespace App\Http\Requests\Admins\ProductVariantValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductVariantValueDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'productvariantvalues.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
