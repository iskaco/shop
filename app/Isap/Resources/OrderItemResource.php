<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Models\OrderItem;


class OrderItemResource extends BaseResource
{
    protected static ?string $model = OrderItem::class;

    public static function form(ActionType $action_type){}

    public static function table(){}
}
