<?php

namespace App\Http\Requests\Admins\Admins;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AdminDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'admins.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
