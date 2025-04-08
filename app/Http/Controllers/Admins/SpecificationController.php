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
use App\Models\Specification;

class SpecificationController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Specification::class, Specification::query());
    }
    public function show($id) {}
    public function store() {}
    public function update($id) {}
    public function destroy($id) {}
}
