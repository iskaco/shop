<?php

namespace App\Http\Requests\Admins\Attributes;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AttributeDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attributes.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
