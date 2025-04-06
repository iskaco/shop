<?php

namespace App\Actions\Categories;

use App\Actions\BaseAction;
use App\Models\Category;


class FeaturedCategoryIndex extends BaseAction
{
    public function execute() /* return value */
    {
        $categories = Category::where('is_featured', true)->get();
        return $categories;
    }
}
