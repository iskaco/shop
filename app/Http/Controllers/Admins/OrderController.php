<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Orders\OrderDestroy;
use App\Actions\Orders\OrderIndex;
use App\Actions\Orders\OrderShow;
use App\Actions\Orders\OrderStore;
use App\Actions\Orders\OrderUpdate;
use App\Http\Requests\Admins\Orders\OrderDestroyRequest;
use App\Http\Requests\Admins\Orders\OrderStoreRequest;
use App\Http\Requests\Admins\Orders\OrderUpdateRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Order::class, Order::query());
    }

    public function show($id)
    {
        
    }

    public function store()
    {
        
    }

    public function update($id)
    {
        
    }
    
    public function destroy($id)
    {
        
    }
}
