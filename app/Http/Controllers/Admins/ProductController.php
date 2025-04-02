<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Products\ProductStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Products\ProductStoreRequest;
use App\Isap\Actions\ActionType;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // dd(request()->cookie('locale'));

        return $this->makeInertiaTableResponse(Product::class, Product::query());
    }

    public function create()
    {
        return $this->makeInertiaFormResponse(Product::class, [], ActionType::STORE);
    }

    public function show($id) {}

    public function store(ProductStoreRequest $request, ProductStore $action)
    {
        //dd($request->all());
        try {
            if (! $action->execute($request->validated())) {
                toast_error(__('messages.product.store.error'));
            } else {
                toast_success(__('messages.product.store.ok'));
            }
            return $this->makeInertiaTableResponse(Product::class, Product::query());
        } catch (\Throwable $th) {
            toast_error(__('messages.product.store.error') . $th->getMessage());
            //dd($th->getMessage());
        }
    }

    public function edit(string $id)
    {
        return $this->makeInertiaFormResponse(Product::class, Product::findOrFail($id), ActionType::UPDATE);
    }

    public function update($id) {}

    public function destroy($id) {}
}
