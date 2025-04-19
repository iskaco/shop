<?php

namespace App\Http\Requests\Admins\Attributes;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AttributeStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attributes.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
