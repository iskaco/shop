<?php

namespace App\Actions\Brands;

use App\Actions\BaseAction;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandStore extends BaseAction
{
    public function execute($data): Brand
    {
        DB::beginTransaction();
        $brand = Brand::create($data);
        if (isset($data['image'])) {
            $brand->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Brand.Images');
        }
        if (isset($data['thumbnail'])) {
            $brand->addMedia($data['thumbnail'])->preservingOriginal()->toMediaCollection('Brand.Thumbnails');
        }
        if (isset($data['banner'])) {
            $brand->addMedia($data['banner'])->preservingOriginal()->toMediaCollection('Brand.Banners');
        }
        DB::commit();
        return $brand;
    }
}
