<?php

namespace App\Http\Requests\Admins\Categories;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends CategoryBaseRequest
{
    public function __construct()
    {
        $this->action = 'categories.update';
    }
}
