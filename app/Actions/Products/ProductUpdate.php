<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Mockery\Exception\RuntimeException;

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
            // code...
            $attributeIds = array_map(function ($id) {
                return ['attribute_id' => $id];
            }, $data['attributes_id']);
            if (! $product->attributes_id()->sync($attributeIds)) {
                DB::rollBack();
                throw new RuntimeException(__('messages.product.update.exception.attributes'));
            }
        }

        DB::commit();

        return $product;
    }
}
