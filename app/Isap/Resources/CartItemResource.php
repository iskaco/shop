<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Models\CartItem;


class CartItemResource extends BaseResource
{
    protected static ?string $model = CartItem::class;

    public static function form(ActionType $action_type){}

    public static function table(){}
}
