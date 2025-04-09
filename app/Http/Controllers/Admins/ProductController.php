<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Products\ProductDestroy;
use App\Actions\Products\ProductStore;
use App\Actions\Products\ProductUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Products\ProductDestroyRequest;
use App\Http\Requests\Admins\Products\ProductStoreRequest;
use App\Http\Requests\Admins\Products\ProductUpdateRequest;
use App\Isap\Actions\ActionType;
use App\Models\Product;
use App\Models\ProductSpecification;

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

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $this->makeInertiaFormResponse(Product::class, $product->toFrontendArray(), ActionType::SHOW);
    }

    public function store(ProductStoreRequest $request, ProductStore $action)
    {
        try {
            if ($action->execute($request->validated()) == null) {
                toast_error(__('messages.product.store.error'));
            } else {
                toast_success(__('messages.product.store.ok'));
                return $this->makeInertiaTableResponse(Product::class, Product::query());
            }
        } catch (\Throwable $th) {
            //dd($th);
            toast_error(__('messages.product.store.error') . $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        return $this->makeInertiaFormResponse(Product::class, Product::findOrFail($id)->toFrontendArray(), ActionType::UPDATE);
    }

    public function update(ProductUpdateRequest $request, ProductUpdate $action, string $id)
    {
        try {
            if (! $action->execute($id, $request->validated())) {
                toast_error(__('messages.product.update.error'));
            } else {
                toast_success(__('messages.product.update.ok'));
                return $this->makeInertiaTableResponse(Product::class, Product::query());
            }
        } catch (\Throwable $th) {
            toast_error(__('messages.product.update.error') . $th->getMessage());
        }
    }


    public function destroy(ProductDestroyRequest $request, ProductDestroy $action, $id)
    {
        try {
            $error_message = $action->execute($id);
            if (!$error_message)
                toast_success(__('messages.product.destroy.ok'));
            else
                toast_error($error_message);
        } catch (\Throwable $th) {
            toast_error(__('messages.product.destroy.error'));
        }
        return $this->makeInertiaTableResponse(Product::class, Product::query());
    }

    public function specifications($id)
    {
        $specification = Product::findOrFail($id)?->specifications;
        dd($specification);
        //return $this->makeInertiaFormResponse(ProductSpecification::class, $specification->toFrontendArray(), ActionType::UPDATE);
    }
}
