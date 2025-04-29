<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Category;

class ProductRandomIndexByCategory extends BaseAction
{
    public function execute(string $category_id, int $number) /* return value */
    {
        return Category::findOrFail($category_id)?->products()?->inRandomOrder()->take($number)->get();
    }
}
