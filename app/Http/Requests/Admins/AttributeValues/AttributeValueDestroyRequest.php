<?php

namespace App\Http\Requests\Admins\AttributeValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AttributeValueDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attributevalues.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
