<?php

namespace App\Http\Requests\Admins\Taxes;

use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class TaxDestroyRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'taxes.destroy';
    }

    public function rules(): array
    {
        return [

        ];
    }
}
