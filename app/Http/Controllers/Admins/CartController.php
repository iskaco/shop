<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Carts\CartDestroy;
use App\Actions\Carts\CartIndex;
use App\Actions\Carts\CartShow;
use App\Actions\Carts\CartStore;
use App\Actions\Carts\CartUpdate;
use App\Http\Requests\Admins\Carts\CartDestroyRequest;
use App\Http\Requests\Admins\Carts\CartStoreRequest;
use App\Http\Requests\Admins\Carts\CartUpdateRequest;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        return $this->makeInertiaTableResponse(Cart::class, Cart::query());
    }
    public function show($id){
        
    }
    public function store(){
        
    }
    public function update($id){
        
    }
    public function destroy($id){
        
    }
}
