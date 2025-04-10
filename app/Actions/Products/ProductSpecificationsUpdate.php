<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;

class ProductSpecificationsUpdate extends BaseAction
{
    public function execute($data, $id)
    {
        $product = Product::findOrFail($id);
        // Transform the data to match the sync method's requirements
        $syncData = [];
        foreach ($data['specifications'] as $specification) {
            $syncData[$specification['specification_id']] = ['value' => $specification['value']];
        }
        $product->specifications()->sync($syncData);
        return $product;
    }
}
