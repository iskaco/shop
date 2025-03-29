<?php

namespace App\Http\Requests\Admins\Brands;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class BrandUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'brands.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
