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
        if ($data['image']) {
            $product->clearMediaCollection('Products.Images');
            $product->addMedia($data['image'])->toMediaCollection('Products.Images');
        }
        DB::commit();
        return $product;
    }
}
