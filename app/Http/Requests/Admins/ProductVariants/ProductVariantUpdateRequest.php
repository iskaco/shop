<?php

namespace App\Http\Requests\Admins\ProductVariants;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductVariantUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'productvariants.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
