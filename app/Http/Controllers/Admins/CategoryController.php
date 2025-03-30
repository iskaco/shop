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
use App\Isap\Actions\ActionType;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return $this->makeInertiaTableResponse(Category::class, Category::query());
    }
    public function show($id) {}
    public function create()
    {
        return $this->makeInertiaFormResponse(Category::class, [], ActionType::STORE);
    }
    public function store(CategoryStoreRequest $request, CategoryStore $action)
    {
        try {
            dd($request->validated());
            if (! $action->execute($request->validated())) {
                toast_error(__('messages.category.store.error'));
            } else {
                toast_success(__('messages.category.store.ok'));
            }

            return $this->makeInertiaTableResponse(Category::class, Category::query());
        } catch (\Throwable $th) {
            toast_error(__('messages.category.store.error'));
        }
    }

    public function update($id) {}
    public function destroy($id) {}
}
