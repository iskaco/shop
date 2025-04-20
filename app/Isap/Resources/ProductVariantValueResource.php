<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Models\ProductVariantValue;


class ProductVariantValueResource extends BaseResource
{
    protected static ?string $model = ProductVariantValue::class;

    public static function form(ActionType $action_type){}

    public static function table(){}
}
