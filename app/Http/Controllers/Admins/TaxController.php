<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Taxes\TaxDestroy;
use App\Actions\Taxes\TaxIndex;
use App\Actions\Taxes\TaxShow;
use App\Actions\Taxes\TaxStore;
use App\Actions\Taxes\TaxUpdate;
use App\Http\Requests\Admins\Taxes\TaxDestroyRequest;
use App\Http\Requests\Admins\Taxes\TaxStoreRequest;
use App\Http\Requests\Admins\Taxes\TaxUpdateRequest;
use App\Isap\Actions\ActionType;
use App\Models\Tax;

class TaxController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Tax::class, Tax::query());
    }
    public function create()
    {
        return $this->makeInertiaFormResponse(Tax::class, [], ActionType::STORE);
    }
    public function show($id)
    {
        $tax = Tax::findOrFail($id);
        return $this->makeInertiaFormResponse(Tax::class, $tax->toFrontendArray(), ActionType::SHOW);
    }
    public function store() {}
    public function edit(string $id)
    {
        return $this->makeInertiaFormResponse(Tax::class, Tax::findOrFail($id)->toFrontendArray(), ActionType::UPDATE);
    }

    public function update($id) {}
    public function destroy($id) {}
}
