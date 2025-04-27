<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductFindVariant extends BaseAction
{
    public function execute(array $data, string $product) /* return value */
    {
        // $product = Product::findOrFail($product);
        $attributeValueIds = $data['attributes']; // e.g. [1, 4]
        $count = count($attributeValueIds);
        $product_variant = ProductVariant::where('product_id', $product)
            ->whereHas('attribute_values', function ($query) use ($attributeValueIds) {
                $query->whereIn('attribute_value_id', $attributeValueIds);
            }, '=', $count) // Must have exactly 2 matching attributes
            ->withCount('attribute_values')
            ->having('attribute_values_count', '=', $count)
            ->first();

        return $product_variant;
    }
}
