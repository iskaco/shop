<?php

namespace App\Http\Requests\Admins\Vendors;

class VendorStoreRequest extends VendorBaseRequest
{
    public function __construct()
    {
        $this->action = 'vendors.store';
    }
}
