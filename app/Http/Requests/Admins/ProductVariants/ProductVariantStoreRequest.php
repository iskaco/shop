<?php

namespace App\Http\Requests\Admins\ProductVariants;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductVariantStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'productvariants.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
