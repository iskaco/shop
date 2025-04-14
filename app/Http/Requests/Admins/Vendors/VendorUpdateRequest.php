<?php

namespace App\Http\Requests\Admins\Vendors;

class VendorUpdateRequest extends VendorBaseRequest
{
    public function __construct()
    {
        $this->action = 'vendors.update';
    }
}
