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
            $brand->addMedia($data['image'])->toMediaCollection('Brands.Images');
        }
        if (isset($data['thumbnail'])) {
            $brand->addMedia($data['thumbnail'])->toMediaCollection('Brands.Thumbnails');
        }
        if (isset($data['banner'])) {
            $brand->addMedia($data['banner'])->toMediaCollection('Brands.Banners');
        }
        DB::commit();
        return $brand;
    }
}
