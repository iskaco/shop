<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Vendors\VendorDestroy;
use App\Actions\Vendors\VendorStore;
use App\Actions\Vendors\VendorUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Vendors\VendorDestroyRequest;
use App\Http\Requests\Admins\Vendors\VendorStoreRequest;
use App\Http\Requests\Admins\Vendors\VendorUpdateRequest;
use App\Isap\Actions\ActionType;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Vendor::class, Vendor::query());
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        return $this->makeInertiaFormResponse(Vendor::class, $vendor->toFrontendArray(), ActionType::SHOW);
    }

    public function create()
    {
        return $this->makeInertiaFormResponse(Vendor::class, [], ActionType::STORE);
    }

    public function store(VendorStoreRequest $request, VendorStore $action)
    {
        try {
            if (! $action->execute($request->validated())) {
                toast_error(__('messages.vendor.store.error'));
            } else {
                toast_success(__('messages.vendor.store.ok'));
            }

            return redirect()->route('admin.vendors');

        } catch (\Throwable $th) {
            toast_error(__('messages.vendor.store.error'));
        }
    }

    public function edit(string $id)
    {
        return $this->makeInertiaFormResponse(Vendor::class, Vendor::findOrFail($id)?->toFrontendArray(), ActionType::UPDATE);
    }

    public function update(VendorUpdateRequest $request, VendorUpdate $action, string $id)
    {
        try {
            if (! $action->execute($id, $request->validated())) {
                toast_error(__('messages.vendor.update.error'));
            } else {
                toast_success(__('messages.vendor.update.ok'));
            }

            return $this->makeInertiaTableResponse(Vendor::class, Vendor::query());
        } catch (\Throwable $th) {
            toast_error(__('messages.vendor.update.error').$th->getMessage());
        }
    }

    public function destroy(VendorDestroyRequest $request, VendorDestroy $action, string $id)
    {
        try {
            $error_message = $action->execute($id);
            if (! $error_message) {
                toast_success(__('messages.vendor.destroy.ok'));
            } else {
                toast_error($error_message);
            }
        } catch (\Throwable $th) {
            toast_error(__('messages.vedor.destroy.error'));
        }
    }
}
