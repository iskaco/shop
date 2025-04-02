<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductStore extends BaseAction
{
    public function execute($data): Product
    {
        DB::beginTransaction();
        $product = Product::create($data);
        if ($data['image']) {
            $product->addMedia($data['image'])->toMediaCollection('Products.Images');
        }
        DB::commit();

        return $product;
    }
}
