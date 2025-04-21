<?php

namespace App\Http\Requests\Admins\Attributes;

class AttributeStoreRequest extends AttributeBaseRequest
{
    public function __construct()
    {
        $this->action = 'attributes.store';
    }
}
