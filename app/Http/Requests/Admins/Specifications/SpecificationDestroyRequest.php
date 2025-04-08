<?php

namespace App\Http\Requests\Admins\Specifications;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class SpecificationDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'specifications.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
