<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Brands\BrandDestroy;
use App\Actions\Brands\BrandStore;
use App\Actions\Brands\BrandUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Brands\BrandDestroyRequest;
use App\Http\Requests\Admins\Brands\BrandStoreRequest;
use App\Http\Requests\Admins\Brands\BrandUpdateRequest;
use App\Isap\Actions\ActionType;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Brand::class, Brand::query());
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        return $this->makeInertiaFormResponse(Brand::class, $brand->toFrontendArray(), ActionType::SHOW);
    }

    public function create()
    {
        return $this->makeInertiaFormResponse(Brand::class, [], ActionType::STORE);
    }

    public function store(BrandStoreRequest $request, BrandStore $action)
    {
        try {
            if (! $action->execute($request->validated())) {
                toast_error(__('messages.brand.store.error'));
            } else {
                toast_success(__('messages.brand.store.ok'));

                return redirect()->route('admin.brands');
                //                return $this->makeInertiaTableResponse(Brand::class, Brand::query());
            }

        } catch (\Throwable $th) {
            toast_error(__('messages.brand.store.error').$th->getMessage());
        }
    }

    public function edit(string $id)
    {
        return $this->makeInertiaFormResponse(Brand::class, Brand::findOrFail($id)?->toFrontendArray(), ActionType::UPDATE);
    }

    public function update(BrandUpdateRequest $request, BrandUpdate $action, string $id)
    {
        try {
            if (! $action->execute($id, $request->validated())) {
                toast_error(__('messages.brand.update.error'));
            } else {
                toast_success(__('messages.brand.update.ok'));

                return redirect()->route('admin.brands');
                // return $this->makeInertiaTableResponse(Brand::class, Brand::query());
            }

        } catch (\Throwable $th) {
            toast_error(__('messages.brand.update.error').$th->getMessage());
        }
    }

    public function destroy(BrandDestroyRequest $request, BrandDestroy $action, $id)
    {
        try {
            $error_message = $action->execute($id);
            if (! $error_message) {
                toast_success(__('messages.brand.destroy.ok'));
            } else {
                toast_error($error_message);
            }
        } catch (\Throwable $th) {
            toast_error(__('messages.brand.destroy.error'));
        }
    }
}
