<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
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
        DB::commit();

        return $product;
    }
}
