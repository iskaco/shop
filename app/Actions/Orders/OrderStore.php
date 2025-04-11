<?php

namespace App\Actions\Orders;

use App\Actions\BaseAction;
use App\Models\Order;

class OrderStore extends BaseAction
{
    public function execute(array $data) /* return value */
    {
        return Order::create($data);
    }
}
