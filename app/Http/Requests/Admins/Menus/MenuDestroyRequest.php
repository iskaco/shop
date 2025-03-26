<?php

namespace App\Http\Requests\Admins\Menus;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class MenuDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'menus.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
