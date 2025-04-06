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
            $brand->clearMediaCollection('Brands.Images');
            $brand->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Brands.Images');
        }
        if (isset($data['thumbnail'])) {
            $brand->clearMediaCollection('Brands.Thumbnails');
            $brand->addMedia($data['thumbnail'])->preservingOriginal()->toMediaCollection('Brands.Thumbnails');
        }
        if (isset($data['banner'])) {
            $brand->clearMediaCollection('Brands.Banners');
            $brand->addMedia($data['banner'])->preservingOriginal()->toMediaCollection('Brands.Banners');
        }
        $brand->update($data);
        DB::commit();
        return $brand;
    }
}
