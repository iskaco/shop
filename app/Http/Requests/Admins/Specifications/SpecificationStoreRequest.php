<?php

namespace App\Http\Requests\Admins\Specifications;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class SpecificationStoreRequest extends SpecificationBaseRequest
{
    public function __construct()
    {
        $this->action = 'specifications.store';
    }
}
