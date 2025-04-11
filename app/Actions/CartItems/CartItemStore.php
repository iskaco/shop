<?php

namespace App\Actions\CartItems;

use App\Actions\BaseAction;
use App\Models\CartItem;

class CartItemStore extends BaseAction
{
    public function execute(array $data) /* return value */
    {
        return CartItem::create($data);
    }
}
