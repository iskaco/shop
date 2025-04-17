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
use App\Http\Resources\CustomerResource;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

        return Inertia::render('web/ProfileView', ['customer' => new CustomerResource(auth('customer')?->user())]);
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
            if ($action->execute($request->validated())) {
                toast_success(__('messages.customer.store.ok'));

                return redirect()->route('shop.signin');
            }
            toast_error(__('messages.customer.store.error'));

        } catch (\Throwable $th) {
            toast_error(__('messages.customer.store.error'));
        }
    }

    public function update(CustomerUpdateRequest $request, CustomerUpdate $action)
    {
        try {
            if ($action->execute($request->validated(), auth('customer')?->user()?->id)) {
                toast_success(__('messages.customer.update.ok'));

                return redirect()->route('shop.customer.profile');
            }
            toast_error(__('messages.customer.update.error'));

        } catch (\Throwable $th) {
            toast_error(__('messages.customer.update.error'));
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

    public function cartInfo()
    {
        return Inertia::render('web/CheckoutInfoView', ['address' => auth('customer')?->user()?->address ?? null]);
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
                'shipping_address' => $items['address'], // 'Street:  Borj Hammoud, Nahr City:   Beirut State/province/area:    Lebanon Phone number:  +961-1-248181 Country calling code:  +961 Country:  Lebanon',
            ]);
            foreach ($items['items'] as $cart_item) {
                $orderItemStoreAction->execute([
                    'order_id' => $order?->id,
                    'product_id' => $cart_item['product_id'],
                    'quantity' => $cart_item['quantity'],
                    'unit_price' => Product::findOrFail($cart_item['product_id'])?->price,
                    'unit_cost' => Product::findOrFail($cart_item['product_id'])?->price,
                    'options' => '{}',
                ]);
            }
            DB::commit();
            toast_success(__('messages.order.store.ok'));

            return redirect()->route('shop.customer.profile');

        } catch (\Throwable $th) {
            // throw $th;
            DB::rollBack();
            dd($th);
            toast_error(__('messages.order.store.error'));
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

    public function logout()
    {
        auth('customer')->logout();
        Session::flush();
        Session::put('success', 'You are logout sucessfully');

        return redirect()->intended(route('home'));
    }
}
