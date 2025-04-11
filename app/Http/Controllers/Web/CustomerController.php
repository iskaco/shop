<?php

namespace App\Http\Controllers\Web;

use App\Actions\Customers\CustomerStore;
use App\Actions\Customers\CustomerUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CustomerLoginRequest;
use App\Http\Requests\Web\Customers\CustomerStoreRequest;
use App\Http\Requests\Web\Customers\CustomerUpdateRequest;
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
        $request->authenticate();
        toast_success(__('messages.customer.login.ok'));

        return redirect()->back();
    }

    public function store(CustomerStoreRequest $request, CustomerStore $action)
    {
        try {
            $action->execute($request->validated());
            toast_success(__('messages.customer.store.ok'));

            return redirect()->back();
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
}
