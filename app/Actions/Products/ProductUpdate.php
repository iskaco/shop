<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;

class ProductUpdate extends BaseAction
{
    public function execute(string $id, $data)
    {
        DB::beginTransaction();
        $product = Product::findOrFail($id);
        $product->update($data);
        if (isset($data['image'])) {
            $product->clearMediaCollection('Product.Images');
            $product->addMedia($data['image'])->preservingOriginal()->toMediaCollection('Product.Images');
        }
        if (isset($data['gallery'])) {
            $product->clearMediaCollection('Product.Galleries');
            foreach ($data['gallery'] as $image) {
                $product->addMedia($image)->preservingOriginal()->toMediaCollection('Product.Galleries');
            }
        }
        // ====TODO check product attribute update problems
        if (isset($data['attributes_id'])) {
            $product->attributes_id->sync(array_column($data['attributes_id'], 'attribute_id'));
            /*foreach ($data['attributes_id'] as $attribute_id) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_id' => $attribute_id,
                ]);
            }*/
        }

        DB::commit();

        return $product;
    }
}
