<?php

namespace App\Http\Requests\Admins\Attributes;

class AttributeUpdateRequest extends AttributeBaseRequest
{
    public function __construct()
    {
        $this->action = 'attributes.update';
    }
}
