<?php

namespace App\Http\Requests\Admins\Permissions;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class PermissionStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'permissions.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
