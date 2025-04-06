<?php

namespace App\Actions\Categories;

use App\Actions\BaseAction;
use App\Models\Category;


class FeaturedCategoryIndex extends BaseAction
{
    public function execute() /* return value */
    {
        $categories = Category::where('featured', true)->get();
        return $categories;
    }
}
