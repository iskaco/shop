<?php

namespace App\Http\Requests\Admins\Brands;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class BrandDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'brands.destroy';
    }

    public function rules(): array
    {
        return [];
    }
}
