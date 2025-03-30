<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Brands\BrandDestroy;
use App\Actions\Brands\BrandIndex;
use App\Actions\Brands\BrandShow;
use App\Actions\Brands\BrandStore;
use App\Actions\Brands\BrandUpdate;
use App\Http\Requests\Admins\Brands\BrandDestroyRequest;
use App\Http\Requests\Admins\Brands\BrandStoreRequest;
use App\Http\Requests\Admins\Brands\BrandUpdateRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index() {}
    public function show($id) {}
    public function store() {}
    public function update($id) {}
    public function destroy($id) {}
    public function create() {}
    public function edit(string $id) {}
}
