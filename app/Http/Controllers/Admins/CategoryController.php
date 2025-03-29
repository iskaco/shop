<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Actions\Categories\CategoryDestroy;
use App\Actions\Categories\CategoryIndex;
use App\Actions\Categories\CategoryShow;
use App\Actions\Categories\CategoryStore;
use App\Actions\Categories\CategoryUpdate;
use App\Http\Requests\Admins\Categories\CategoryDestroyRequest;
use App\Http\Requests\Admins\Categories\CategoryStoreRequest;
use App\Http\Requests\Admins\Categories\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Category::class, Category::query());
    }
    public function show($id) {}
    public function store() {}
    public function update($id) {}
    public function destroy($id) {}
}
