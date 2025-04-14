<?php

namespace App\Actions\Vendors;

use App\Actions\BaseAction;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class VendorStore extends BaseAction
{
    public function execute(array $data) /* return value */
    {
        DB::beginTransaction();
        $brand = Vendor::create($data);
        if (isset($data['image'])) {
            $brand->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Vendor.Images');
        }
        if (isset($data['thumbnail'])) {
            $brand->addMedia($data['thumbnail'])->preservingOriginal()->toMediaCollection('Vendor.Thumbnails');
        }
        if (isset($data['banner'])) {
            $brand->addMedia($data['banner'])->preservingOriginal()->toMediaCollection('Vendor.Banners');
        }
        DB::commit();

        return $brand;
    }
}
