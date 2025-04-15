<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Isap\Actions\ActionType;
use App\Models\Customer;

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
}
