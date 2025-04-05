<?php

namespace App\Actions\Brands;

use App\Actions\BaseAction;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandDestroy extends BaseAction
{
    public function execute($id) /* return value */
    {
        DB::beginTransaction();
        $brand = Brand::findOrFail($id);
        if ($brand->products()->exists())
            return __('messages.brand.destroy.has_product');
        $brand->delete();
        DB::commit();
        return null;
    }
}
