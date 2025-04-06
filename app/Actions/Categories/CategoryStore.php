<?php

namespace App\Actions\Categories;

use App\Actions\BaseAction;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryStore extends BaseAction
{
    public function execute(array $data) /* return value */
    {
        DB::beginTransaction();
        $category = Category::create($data);
        if (isset($data['image'])) {
            $category->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Category.Images');
        }
        if (isset($data['banner'])) {
            $category->addMedia($data['banner'])->preservingOriginal()->toMediaCollection('Category.Banners');
        }
        if (isset($data['thumbnail'])) {
            $category->addMedia($data['thumbnail'])->preservingOriginal()->toMediaCollection('Category.Thumbnails');
        }
        DB::commit();
        return $category;
    }
}
