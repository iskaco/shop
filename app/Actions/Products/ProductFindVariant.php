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
        $product = Product::findOrFail($product);
        $attributeValueIds = $data['attributes']; // e.g. [1, 4]
        $count = count($attributeValueIds);
        // dd($attributeValueIds);
        foreach ($product?->variants as $variant) {
            $variant_values = $variant?->variant_values()->pluck('attribute_value_id')->toArray();
            if ($variant_values == $attributeValueIds) {
                return $variant;
            }
        }

        return false;

        /*$product_variant = ProductVariant::where('product_id', $product)
            ->whereHas('variant_values', function ($query) use ($attributeValueIds) {
                $query->whereIn('attribute_value_id', $attributeValueIds);
            }) // Must have exactly 2 matching attributes
            ->withCount('variant_values')
            ->having('variant_values_count', '=', $count)
            ->first();
*/
    }
}
