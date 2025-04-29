<?php

namespace App\Http\Requests\Admins\Attributes;

use App\Http\Requests\Admins\AdminsAuthRequest;

class AttributeDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attributes.destroy';
    }
}
