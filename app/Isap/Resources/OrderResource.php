<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Tables\Columns\TextColumn;
use App\Models\Order;
use App\Isap\Forms\Form;
use App\Isap\Tables\Table;


class OrderResource extends BaseResource
{
    protected static ?string $model = Order::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.order.plural'), Order::class);

        return $form->components([

        ])->action(static::getAction($action_type)?->setRoute('order.' . lcfirst($action_type->value)));
    
    }

    public static function table(){
        return (new Table(__('resources.oorder.plural'), Order::class))
            ->columns([
                TextColumn::make('user_name', __('resources.order.user_name')),
                TextColumn::make('status', __('resources.order.status')),
            ])
            ->row_actions([])
            ->table_actions([
            ]);
    }
}
