<?php

namespace App\Http\Controllers\Web;

use App\Actions\Categories\FeaturedCategoryIndex;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index() {}
    public function featuredCategories(FeaturedCategoryIndex $action)
    {
        $categories = $action->execute();
        return inertia('web/Category/FeaturedCategories', [
            'categories' => $categories,
        ]);
    }

    public function show($slug)
    {
        return inertia('web/Category/Show', [
            'category' => $slug,
        ]);
    }
}
