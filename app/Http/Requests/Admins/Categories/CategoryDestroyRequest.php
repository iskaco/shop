<?php

namespace App\Http\Requests\Admins\Categories;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class CategoryDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'categories.destroy';
    }
}
