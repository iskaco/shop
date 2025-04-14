<?php

namespace App\Actions\Vendors;

use App\Actions\BaseAction;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class VendorDestroy extends BaseAction
{
    public function execute(string $id) /* return value */
    {
        DB::beginTransaction();
        $brand = Vendor::findOrFail($id);
        if ($brand->products()->exists()) {
            return __('messages.vendor.destroy.has_product');
        }
        $brand->delete();
        DB::commit();

        return null;
    }
}
