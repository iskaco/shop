<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;

class ProductStore extends BaseAction
{
    public function execute($data): Product
    {
        DB::beginTransaction();
        // dd($data); // Debug the input data
        $product = Product::create($data);
        if (isset($data['image'])) {
            $product->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Product.Images');
        }
        if (isset($data['gallery'])) {
            foreach ($data['gallery'] as $image) {
                $product->addMedia($image)->preservingOriginal()->toMediaCollection('Product.Galleries');
            }
        }
        if (isset($data['attributes_id'])) {
            foreach ($data['attributes_id'] as $attribute_id) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_id' => $attribute_id,
                ]);
            }
        }
        // Create default variant
        ProductVariant::firstOrCreate([
            'product_id' => $product?->id,
            'sku' => $product?->slug,
            'price_factor' => 1,
            'stock' => $product?->stock,
            'is_active' => true,
        ]);

        DB::commit();

        return $product;
    }
}
