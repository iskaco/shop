<?php

namespace App\Http\Controllers\Web;

use App\Actions\CartItems\CartItemStore;
use App\Actions\Carts\CartStore;
use App\Actions\Customers\CustomerStore;
use App\Actions\Customers\CustomerUpdate;
use App\Actions\OrderItems\OrderItemStore;
use App\Actions\Orders\OrderStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\CartItems\CartItemStoreRequest;
use App\Http\Requests\Auth\CustomerLoginRequest;
use App\Http\Requests\Web\Customers\CustomerStoreRequest;
use App\Http\Requests\Web\Customers\CustomerUpdateRequest;
use App\Http\Requests\Web\Orders\OrderStoreRequest;
use App\Models\Product;
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

    public function profile()
    {
        return Inertia::render('web/ProfileView');
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
            // dd($th);
        }
    }

    public function storeOrder(OrderStoreRequest $request, OrderStore $orderStoreAction, OrderItemStore $orderItemStoreAction)
    {
        try {
            DB::beginTransaction();
            $items = $request->validated();
            $total = $this->calcItemsTotalPrice($items);
            $order = $orderStoreAction->execute([
                'customer_id' => auth('customer')?->user()?->id,
                'status' => 'shipped',
                'subtotal' => $total,
                'tax_amount' => 0,
                'discount_amount' => 0,
                'shipping_cost' => 0,
                'total' => $total,
                'payment_method' => 'cash',
                'shipping_address' => 'Street:  Borj Hammoud, Nahr City:   Beirut State/province/area:    Lebanon Phone number:  +961-1-248181 Country calling code:  +961 Country:  Lebanon',
            ]);
            foreach ($items['items'] as $cart_item) {
                $orderItemStoreAction->execute([
                    'order_id' => $order?->id,
                    'product_id' => $cart_item['product_id'],
                    'quantity' => $cart_item['quantity'],
                    'unit_price' => Product::findOrFail($cart_item['product_id'])?->price,
                    'unit_cost' => Product::findOrFail($cart_item['product_id'])?->price,
                    'options' => '',
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
        }
    }

    private function calcItemsTotalPrice($cart_items)
    {
        $total = 0;
        foreach ($cart_items['items'] as $cart_item) {
            $total += Product::findOrFail($cart_item['product_id'])?->price * $cart_item['quantity'];
        }

        return $total;
    }
}
