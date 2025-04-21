<?php

namespace App\Actions\Attributes;

use App\Actions\BaseAction;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class AttributeDestroy extends BaseAction
{
    public function execute(string $id) /* return value */
    {
        DB::beginTransaction();
        $attribute = Attribute::findOrFail($id);
        /*if ($product->order_items()->exists())
            return __('messages.product.destroy.has_order');*/
        $attribute->delete();
        DB::commit();

        return null;
    }
}
