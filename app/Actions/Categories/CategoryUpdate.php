<?php

namespace App\Actions\Categories;

use App\Actions\BaseAction;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryUpdate extends BaseAction
{
    public function execute(string $id, $data) /* return value */
    {
        DB::beginTransaction();
        $category = Category::findOrFail($id);
        $category->update($data);
        if ($data['image']) {
            $category->clearMediaCollection('Categories.Images');
            $category->addMedia($data['image'])->toMediaCollection('Categories.Images');
        }
        if ($data['thumbnail']) {
            $category->clearMediaCollection('Categories.Thumbnails');
            $category->addMedia($data['thumbnail'])->toMediaCollection('Categories.Thumbnails');
        }
        if ($data['banner']) {
            $category->clearMediaCollection('Categories.Banners');
            $category->addMedia($data['banner'])->toMediaCollection('Categories.Banners');
        }
        DB::commit();
        return $category;
    }
}
