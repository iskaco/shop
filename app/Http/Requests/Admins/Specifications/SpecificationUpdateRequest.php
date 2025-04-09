<?php

namespace App\Http\Requests\Admins\Specifications;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Models\Specification;
use Illuminate\Validation\Rule;

class SpecificationUpdateRequest extends SpecificationBaseRequest
{
    public function __construct()
    {
        $this->action = 'specifications.update';
    }
}
