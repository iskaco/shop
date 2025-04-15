<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Isap\Actions\ActionType;
use App\Models\Customer;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Customer::class, Customer::query());

    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return $this->makeInertiaFormResponse(Customer::class, $customer, ActionType::SHOW);
    }

    public function store() {}

    public function update($id) {}

    public function destroy($id) {}

    public function orders($id)
    {
        return $this->makeInertiaTableResponse(Order::class, Order::where('customer_id', $id));

    }
}
