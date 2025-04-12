<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\ShowAction;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Models\OrderItem;

class OrderItemResource extends BaseResource
{
    protected static ?string $model = OrderItem::class;

    public static function form(ActionType $action_type) {}

    public static function table()
    {
        return (new Table(__('resources.order_item.plural'), OrderItem::class))
            ->columns([
                TextColumn::make('product_name', __('resources.order_item.product_name')),
                TextColumn::make('quantity', __('resources.order_item.quantity')),
                TextColumn::make('price', __('resources.order_item.price')),
            ])
            ->row_actions([
                ShowAction::make('show', __('resources.actions.show'))->setRoute('order.show')->setIcon('md-removeredeye-outlined'),

            ])
            ->table_actions([
            ]);
    }
}
