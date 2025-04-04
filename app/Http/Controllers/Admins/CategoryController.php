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
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $this->makeInertiaFormResponse(Category::class, $category->toFrontendArray(), ActionType::SHOW);
    }
    public function create()
    {
        return $this->makeInertiaFormResponse(Category::class, [], ActionType::STORE);
    }
    public function store(CategoryStoreRequest $request, CategoryStore $action)
    {
        try {
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

    public function edit(string $id)
    {
        return $this->makeInertiaFormResponse(Category::class, Category::findOrFail($id)?->toFrontendArray(), ActionType::UPDATE);
    }
    public function update(CategoryUpdateRequest $request, CategoryUpdate $action, string $id)
    {
        try {
            if (! $action->execute($id, $request->validated())) {
                toast_error(__('messages.category.update.error'));
            } else {
                toast_success(__('messages.category.update.ok'));
            }

            return $this->makeInertiaTableResponse(Category::class, Category::query());
        } catch (\Throwable $th) {
            toast_error(__('messages.category.update.error') . $th->getMessage());
        }
    }

    public function destroy(CategoryDestroyRequest $request, CategoryDestroy $action, string $id)
    {
        $error_message = $action->execute($id);
        if (!$error_message)
            toast_success(__('messages.category.destroy.ok'));
        else
            toast_error($error_message);
        return $this->makeInertiaTableResponse(Category::class, Category::query());
    }
}
