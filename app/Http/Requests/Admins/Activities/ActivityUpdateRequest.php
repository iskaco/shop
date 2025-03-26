<?php

namespace App\Http\Requests\Admins\Activities;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ActivityUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'activities.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
