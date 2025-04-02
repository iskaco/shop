<?php

namespace App\Http\Requests\Admins\Brands;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class BrandStoreRequest extends BrandBaseRequest
{
    public function __construct()
    {
        $this->action = 'brands.store';
    }
}
