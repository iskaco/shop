<?php

namespace App\Http\Requests\Admins\AttributeValues;

class AttributeValueStoreRequest extends AttributeValueBaseRequest
{
    public function __construct()
    {
        $this->action = 'attribute_values.store';
    }
}
