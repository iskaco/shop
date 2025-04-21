<?php

namespace App\Http\Controllers\Admins;

use App\Actions\Attributes\AttributeDestroy;
use App\Actions\Attributes\AttributeStore;
use App\Actions\Attributes\AttributeUpdate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\Attributes\AttributeDestroyRequest;
use App\Http\Requests\Admins\Attributes\AttributeStoreRequest;
use App\Http\Requests\Admins\Attributes\AttributeUpdateRequest;
use App\Isap\Actions\ActionType;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Attribute::class, Attribute::query());

    }

    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);

        return $this->makeInertiaFormResponse(Attribute::class, $attribute->toFrontendArray(), ActionType::SHOW);

    }

    public function create()
    {
        return $this->makeInertiaFormResponse(Attribute::class, [], ActionType::STORE);
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);

        return $this->makeInertiaFormResponse(Attribute::class, $attribute->toFrontendArray(), ActionType::EDIT);
    }

    public function store(AttributeStoreRequest $request, AttributeStore $action)
    {
        try {
            if ($action->execute($request->validated())) {
                toast_success(__('messages.attribute.store.ok'));

                return redirect()->route('admin.attributes');
            }
            toast_error(__('messages.attribute.store.error'));

        } catch (\Throwable $th) {
            toast_error(__('messages.attribute.store.error'));

        }
    }

    public function update(AttributeUpdateRequest $request, AttributeUpdate $action, $id)
    {
        try {
            if ($action->execute($request->validated(), $id)) {
                toast_success(__('messages.attribute.update.ok'));

                return redirect()->route('admin.attributes');
            }
            toast_error(__('messages.attribute.update.error'));

        } catch (\Throwable $th) {
            toast_error(__('messages.attribute.update.error'));
        }
    }

    public function destroy(AttributeDestroyRequest $request, AttributeDestroy $action, $id)
    {
        try {
            $error_message = $action->execute($id);
            if (! $error_message) {
                toast_success(__('messages.attribute.destroy.ok'));
            } else {
                toast_error($error_message);
            }
        } catch (\Throwable $th) {
            toast_error(__('messages.attribute.destroy.error'));
        }

        return redirect()->route('admin.attributes');
    }
}
