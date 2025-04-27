<?php

namespace App\Actions\Products;

use App\Actions\BaseAction;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductVariantsUpdate extends BaseAction
{
    public function execute(array $data, string $id) /* return value */
    {
        $product = Product::findOrFail($id);
        $variantIds = $data['variantIds'];
        unset($data['variantIds']);

        $validated = $data;
        DB::transaction(function () use ($product, $variantIds, $validated) {
            foreach ($variantIds as $id) {
                $variant = $product->variants()->findOrFail($id);

                $variant->update([
                    'price_factor' => $validated["price_factor_$id"],
                    'stock' => $validated["stock_$id"],
                    'stock_zone' => $validated["stock_zone_$id"] ?? null,
                    'barcode' => $validated["barcode_$id"] ?? null,
                    'updated_at' => now(),
                ]);
            }
        });

        return true;
        throw new Exception(__('messages.product.variant.update.error'));
    }
}
