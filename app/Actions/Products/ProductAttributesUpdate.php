<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\AttributeValue;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductAttributesUpdate extends BaseAction
{
    public function execute($data, $id)
    {
        DB::beginTransaction();
        $product = Product::findOrFail($id);
        // Disable all of previous variants of product
        $product->variants()->update([
            'is_active' => false,
        ]);
        $combinations = $this->getAttributeValuesCombination($data);
        foreach ($combinations as $combination) {
            // code...
            $variant = $product?->variants()?->create([
                'sku' => $product->slug.'-'.$this->generateSku($combination),
                'price_factor' => 1, // default is 1
                'stock' => $product?->stock,
            ]);
            foreach ($combination as $value) {
                $variant?->variant_values()?->create([
                    'product_variant_id' => $variant?->id,
                    'attribute_value_id' => $value,
                ]);
            }
        }
        DB::commit();

        return $product;
    }

    private function generateSku($array_values)
    {
        $sku = '';
        foreach ($array_values as $array_value) {
            $sku .= '-'.AttributeValue::findOrFail($array_value)?->getTranslation('value', 'en');
        }

        return $sku;
    }

    private function getAttributeValuesCombination($data)
    {
        $attributesWithValues = collect($data['attributes_id'])->groupBy('attribute_id')->map(function ($items) {
            return $items->pluck('value_id');
        });

        $combinations = Arr::crossJoin(...$attributesWithValues->values());

        return $combinations;
    }
}
