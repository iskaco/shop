<?php

namespace App\Http\Requests\Admins\Menus;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class MenuStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'menus.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
