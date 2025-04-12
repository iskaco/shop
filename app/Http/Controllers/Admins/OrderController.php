<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Isap\Actions\ActionType;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Order::class, Order::query());
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        return $this->makeInertiaFormResponse(Order::class, $order, ActionType::SHOW);
    }

    public function store() {}

    public function update($id) {}

    public function destroy($id) {}

    public function orderItems($id)
    {
        return $this->makeInertiaTableResponse(OrderItem::class, OrderItem::where('order_id', $id));

    }
}
