<?php

namespace App\Http\Requests\Admins\Permissions;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class PermissionDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'permissions.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
