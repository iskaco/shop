<?php

namespace App\Actions\Categories;

use App\Actions\BaseAction;
use App\Models\Category;


class CategoryDestroy extends BaseAction
{
    public function execute(string $id)
    {

        $category = Category::find($id);
        if ($category->products()->exists())
            return __('messages.category.destroy.has_product');
        if ($category->children()->exists())
            return __('messages.category.destroy.has_children');
        $category->delete();
        return null;
    }
}
