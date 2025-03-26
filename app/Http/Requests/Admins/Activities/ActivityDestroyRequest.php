<?php

namespace App\Http\Requests\Admins\Activities;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ActivityDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'activities.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
