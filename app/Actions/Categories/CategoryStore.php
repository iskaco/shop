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
        if ($data['image']) {
            $category->addMedia($data['image'])->toMediaCollection('Category.Images');
        }
        if ($data['banner']) {
            $category->addMedia($data['banner'])->toMediaCollection('Category.Banners');
        }
        if ($data['thumbnail']) {
            $category->addMedia($data['thumbnail'])->toMediaCollection('Category.Thumbnails');
        }
        DB::commit();
        return $category;
    }
}
