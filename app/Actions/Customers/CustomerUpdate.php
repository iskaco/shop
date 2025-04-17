<?php

namespace App\Actions\Customers;

use App\Actions\BaseAction;
use App\Models\Customer;

class CustomerUpdate extends BaseAction
{
    public function execute(array $data, string $id) /* return value */
    {
        $customer = Customer::findOrFail($id);

        return $customer->update($data);
    }
}
