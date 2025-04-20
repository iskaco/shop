<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Category;

class ProductIndexByCategory extends BaseAction
{
    public function execute(string $category_id) /* return value */
    {
        return Category::findOrFail($category_id)?->products;
    }
}
