<?php

namespace App\Http\Controllers\Web;

use App\Actions\Categories\CategoryIndex;
use App\Actions\Categories\FeaturedCategoryIndex;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    //
    public function index(CategoryIndex $action)
    {
        $categories = $action->execute();
        return inertia('web/CategoriesView', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }
    public function featuredCategories(FeaturedCategoryIndex $action)
    {
        $categories = $action->execute();
        return inertia('web/Category/FeaturedCategories', [
            'categories' => CategoryResource::collection($categories),
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return Inertia::render('web/CategoryView', [
            'category' => CategoryResource::make($category),
            'products' => ProductResource::collection($category?->products),
        ]);
    }
}
