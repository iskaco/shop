<?php

namespace App\Http\Requests\Admins\Permissions;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class PermissionUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'permissions.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
