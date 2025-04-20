<?php

namespace App\Http\Requests\Admins\ProductVariants;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductVariantDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'productvariants.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
