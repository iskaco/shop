<?php

namespace App\Http\Requests\Admins\Attributes;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AttributeUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attributes.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
