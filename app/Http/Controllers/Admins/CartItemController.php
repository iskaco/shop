<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\CartItems\CartItemDestroy;
use App\Actions\CartItems\CartItemIndex;
use App\Actions\CartItems\CartItemShow;
use App\Actions\CartItems\CartItemStore;
use App\Actions\CartItems\CartItemUpdate;
use App\Http\Requests\Admins\CartItems\CartItemDestroyRequest;
use App\Http\Requests\Admins\CartItems\CartItemStoreRequest;
use App\Http\Requests\Admins\CartItems\CartItemUpdateRequest;
use App\Models\CartItem;

class CartItemController extends Controller
{
    public function index(){
        return $this->makeInertiaTableResponse(CartItem::class, CartItem::query());        
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
