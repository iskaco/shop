<?php

namespace App\Http\Requests\Admins\AttributeValues;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class AttributeValueStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'attributevalues.store';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
