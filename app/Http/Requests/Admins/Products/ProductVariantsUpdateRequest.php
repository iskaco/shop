<?php

namespace App\Http\Requests\Admins\Products;

use App\Http\Requests\Admins\AdminsAuthRequest;

class ProductVariantsUpdateRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'products.vriants.update';
    }

    public function rules(): array
    {
        $rules = [];

        // Get all variant IDs from the input keys
        $variantIds = [];
        foreach ($this->all() as $key => $value) {
            if (preg_match('/_(\d+)$/', $key, $matches)) {
                $variantIds[] = $matches[1];
            }
        }

        $variantIds = array_unique($variantIds);

        // Add rules for each variant
        foreach ($variantIds as $id) {
            $rules["price_factor_$id"] = ['required', 'numeric', 'min:0'];
            $rules["stock_$id"] = ['required', 'integer', 'min:0'];
            $rules["stock_zone_$id"] = ['nullable', 'string', 'max:255'];
            $rules["barcode_$id"] = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }
}
