<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Specifications\SpecificationDestroy;
use App\Actions\Specifications\SpecificationIndex;
use App\Actions\Specifications\SpecificationShow;
use App\Actions\Specifications\SpecificationStore;
use App\Actions\Specifications\SpecificationUpdate;
use App\Http\Requests\Admins\Specifications\SpecificationDestroyRequest;
use App\Http\Requests\Admins\Specifications\SpecificationStoreRequest;
use App\Http\Requests\Admins\Specifications\SpecificationUpdateRequest;
use App\Isap\Actions\ActionType;
use App\Models\Specification;

class SpecificationController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Specification::class, Specification::query());
    }
    public function create()
    {
        return $this->makeInertiaFormResponse(Specification::class, [], ActionType::STORE);
    }
    public function store(SpecificationStoreRequest $request, SpecificationStore $action)
    {
        try {
            if ($action->execute($request->validated()) == null) {
                toast_error(__('messages.specification.store.error'));
            } else {
                toast_success(__('messages.specification.store.ok'));
                return $this->makeInertiaTableResponse(Specification::class, Specification::query());
            }
        } catch (\Throwable $th) {
            dd($th);
            toast_error(__('messages.specification.store.error') . $th->getMessage());
        }
    }

    public function show($id) {}
    public function update($id) {}
    public function destroy($id) {}
}
