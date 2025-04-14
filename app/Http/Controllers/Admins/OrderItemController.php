<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Isap\Actions\ActionType;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    public function index() {}

    public function show($id)
    {
        $order_item = OrderItem::findOrFail($id);

        return $this->makeInertiaFormResponse(OrderItem::class, $order_item, ActionType::SHOW);
    }

    public function store() {}

    public function update($id) {}

    public function destroy($id) {}
}
