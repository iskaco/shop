<?php

namespace App\Http\Requests\Admins\Brands;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class BrandStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'brands.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
