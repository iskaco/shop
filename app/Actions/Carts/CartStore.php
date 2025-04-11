<?php

namespace App\Actions\Carts;

use App\Actions\BaseAction;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartStore extends BaseAction
{
    public function execute() /* return value */
    {
        return Cart::create([
            'session_id' => Session::getId(),
            'customer_id' => auth('customer')?->user()?->id,
        ]);
    }
}
