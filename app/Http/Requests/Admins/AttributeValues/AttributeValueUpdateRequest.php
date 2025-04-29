<?php

namespace App\Http\Requests\Admins\AttributeValues;

class AttributeValueUpdateRequest extends AttributeValueBaseRequest
{
    public function __construct()
    {
        $this->action = 'attribute_values.update';
    }
}
