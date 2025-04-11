<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Models\Order;

class OrderResource extends BaseResource
{
    protected static ?string $model = Order::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.order.plural'), Order::class);

        return $form->components([

        ])->action(static::getAction($action_type)?->setRoute('order.'.lcfirst($action_type->value)));

    }

    public static function table()
    {
        return (new Table(__('resources.order.plural'), Order::class))
            ->columns([
                TextColumn::make('customer_name', __('resources.order.customer')),
                TextColumn::make('status', __('resources.order.status')),
                TextColumn::make('total', __('resources.order.total')),
            ])
            ->row_actions([])
            ->table_actions([
            ]);
    }
}
