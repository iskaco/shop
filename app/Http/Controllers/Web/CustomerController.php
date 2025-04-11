<?php

namespace App\Http\Controllers\Web;

use App\Actions\CartItems\CartItemStore;
use App\Actions\Carts\CartStore;
use App\Actions\Customers\CustomerStore;
use App\Actions\Customers\CustomerUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\CartItems\CartItemStoreRequest;
use App\Http\Requests\Auth\CustomerLoginRequest;
use App\Http\Requests\Web\Customers\CustomerStoreRequest;
use App\Http\Requests\Web\Customers\CustomerUpdateRequest;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CustomerController extends Controller
{
    //
    public function signin()
    {
        return Inertia::render('web/SigninView');
    }

    public function signup()
    {
        return Inertia::render('web/SignupView');
    }

    public function authenticate(CustomerLoginRequest $request)
    {
        try {
            $request->authenticate();
            toast_success(__('messages.customer.login.ok'));

            return redirect()->route('home');
        } catch (\Throwable $th) {
            toast_error(__('messages.customer.login.error'));
        }

    }

    public function store(CustomerStoreRequest $request, CustomerStore $action)
    {
        try {
            $action->execute($request->validated());
            toast_success(__('messages.customer.store.ok'));

            return redirect()->route('shop.signin');
        } catch (\Throwable $th) {
            toast_error(__('messages.customer.store.error'));
        }
    }

    public function update(CustomerUpdateRequest $request, CustomerUpdate $action)
    {
        try {
            $action->execute($request->validated());
            toast_success(__('messages.customer.update.ok'));

        } catch (\Throwable $th) {
        }

    }

    public function storeCartItems(CartItemStoreRequest $request, CartStore $cartStoreAction, CartItemStore $cartItemStoreAction)
    {
        try {
            // code...
            // dd($request->validated());
            DB::beginTransaction();
            $cart = $cartStoreAction->execute();
            $cart_items = $request->validated();
            // dd($cart_items);
            foreach ($cart_items['items'] as $cart_item) {
                $cartItemStoreAction->execute(['cart_id' => $cart?->id, 'product_id' => $cart_item['product_id'], 'quantity' => $cart_item['quantity']]);
            }
            DB::commit();
            toast_success(__('messages.cart.checkout.ok'));

        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}
