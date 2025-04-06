<?php

namespace App\Actions\Brands;

use App\Actions\BaseAction;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandUpdate extends BaseAction
{
    public function execute(string $id, $data)
    {
        DB::beginTransaction();
        $brand = Brand::findOrFail($id);
        if (isset($data['image'])) {
            $brand->clearMediaCollection('Brand.Images');
            $brand->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Brand.Images');
        }
        if (isset($data['thumbnail'])) {
            $brand->clearMediaCollection('Brand.Thumbnails');
            $brand->addMedia($data['thumbnail'])->preservingOriginal()->toMediaCollection('Brand.Thumbnails');
        }
        if (isset($data['banner'])) {
            $brand->clearMediaCollection('Brand.Banners');
            $brand->addMedia($data['banner'])->preservingOriginal()->toMediaCollection('Brand.Banners');
        }
        $brand->update($data);
        DB::commit();
        return $brand;
    }
}
