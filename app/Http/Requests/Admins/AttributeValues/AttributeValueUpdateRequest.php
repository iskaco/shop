<?php

namespace App\Http\Requests\Admins\AttributeValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AttributeValueUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attributevalues.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
