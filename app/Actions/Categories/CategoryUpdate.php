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
        if (isset($data['image'])) {
            $category->clearMediaCollection('Category.Images');
            $category->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Category.Images');
        }
        if (isset($data['thumbnail'])) {
            $category->clearMediaCollection('Category.Thumbnails');
            $category->addMedia($data['thumbnail'])->preservingOriginal()->toMediaCollection('Category.Thumbnails');
        }
        if (isset($data['banner'])) {
            $category->clearMediaCollection('Category.Banners');
            $category->addMedia($data['banner'])->preservingOriginal()->toMediaCollection('Category.Banners');
        }
        DB::commit();
        return $category;
    }
}
