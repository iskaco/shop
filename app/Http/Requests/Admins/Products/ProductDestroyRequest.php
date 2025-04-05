<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ProductDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'products.destroy';
    }

    public function rules(): array
    {
        return [];
    }
}
