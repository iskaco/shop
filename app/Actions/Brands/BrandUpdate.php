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
        if ($data['image']) {
            $brand->clearMediaCollection('Brands.Images');
            $brand->addMedia($data['image'])->toMediaCollection('Brands.Images');
        }
        if ($data['thumbnail']) {
            $brand->clearMediaCollection('Brands.Thumbnails');
            $brand->addMedia($data['thumbnail'])->toMediaCollection('Brands.Thumbnails');
        }
        if ($data['banner']) {
            $brand->clearMediaCollection('Brands.Banners');
            $brand->addMedia($data['banner'])->toMediaCollection('Brands.Banners');
        }
        $brand->update($data);
        DB::commit();
        return $brand;
    }
}
