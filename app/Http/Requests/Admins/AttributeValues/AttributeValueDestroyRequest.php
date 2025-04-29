<?php

namespace App\Http\Requests\Admins\AttributeValues;

use App\Http\Requests\Admins\AdminsAuthRequest;

class AttributeValueDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attribute_values.destroy';
    }
}
