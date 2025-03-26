<?php

namespace App\Http\Requests\Admins\Menus;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class MenuUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'menus.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
