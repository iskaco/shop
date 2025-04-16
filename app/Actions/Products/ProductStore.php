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
        DB::commit();

        return $product;
    }
}
