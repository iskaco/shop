<?php

namespace App\Http\Controllers\Admins;

use App\Actions\AttributeValues\AttributeValueDestroy;
use App\Actions\AttributeValues\AttributeValueStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\AttributeValues\AttributeValueStoreRequest;
use App\Isap\Actions\ActionType;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(AttributeValue::class, AttributeValue::query());
    }

    public function show($id)
    {
        $attribute_value = AttributeValue::findOrFail($id);

        return $this->makeInertiaFormResponse(AttributeValue::class, $attribute_value->toFrontendArray(), ActionType::SHOW);
    }

    public function create()
    {
        return $this->makeInertiaFormResponse(AttributeValue::class, [], ActionType::STORE);
    }

    public function edit($id)
    {
        $attribute_value = AttributeValue::findOrFail($id);

        return $this->makeInertiaFormResponse(AttributeValue::class, $attribute_value->toFrontendArray(), ActionType::EDIT);
    }

    public function store(AttributeValueStoreRequest $request, AttributeValueStore $action)
    {
        try {
            if ($action->execute($request->validated())) {
                toast_success(__('messages.attribute_value.store.ok'));

                return redirect()->route('admin.attribute_values');
            }
            toast_error(__('messages.attribute_value.store.error'));
        } catch (\Throwable $th) {
            toast_error(__('messages.attribute_value.store.error'));
        }
    }

    public function update($id) {}

    public function destroy($id, AttributeValueDestroy $action)
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

        return redirect()->route('admin.attribute_values');
    }
}
