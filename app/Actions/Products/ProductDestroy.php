<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductDestroy extends BaseAction
{
    public function execute($id) /* return value */
    {
        DB::beginTransaction();
        $product = Product::findOrFail($id);
        if ($product->order_items()->exists())
            return __('messages.product.destroy.has_order');
        $product->delete();
        DB::commit();
        return null;
    }
}
