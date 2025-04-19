<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
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

    public function store() {}

    public function update($id) {}

    public function destroy($id) {}
}
