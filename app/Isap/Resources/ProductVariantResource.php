<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Models\ProductVariant;


class ProductVariantResource extends BaseResource
{
    protected static ?string $model = ProductVariant::class;

    public static function form(ActionType $action_type){}

    public static function table(){}
}
