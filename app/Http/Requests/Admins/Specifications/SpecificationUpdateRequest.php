<?php

namespace App\Http\Requests\Admins\Specifications;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class SpecificationUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'specifications.update';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
