<?php

namespace App\Http\Requests\Admins\Vendors;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class VendorDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'vendors.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
