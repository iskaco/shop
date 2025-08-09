<?php

namespace App\Actions\Attributes;

use App\Actions\BaseAction;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;

class AttributeDestroy extends BaseAction
{
    public function execute(string $id) /* return value */
    {
        try {
            //code...
            DB::beginTransaction();
            $attribute = Attribute::findOrFail($id);
            /*if ($product->order_items()->exists())
                return __('messages.product.destroy.has_order');*/
            $product_attributes = ProductAttribute::where('attribute_id', $attribute->id)->get();
            if ($product_attributes)
                return __('messages.attribute.destroy.has_product');
            $attribute->delete();
            DB::commit();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        return false;
    }
}
