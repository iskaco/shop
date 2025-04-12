<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\OrderItemsAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\TextInput;
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
            FormSection::make('another_info', __('resources.order.another_info'))->children([
                TextInput::make('total', __('resources.order.total')),
                TextInput::make('customer_name', __('resources.order.customer'))->isRequired(),
                TextInput::make('status', __('resources.order.status'))->isRequired(),
                TextInput::make('shipping_address', __('resources.order.shipping_address'))->isRequired(),
                TextInput::make('billing_address', __('resources.order.billing_address'))->isRequired(),
                TextInput::make('payment_method', __('resources.order.payment_method'))->isRequired(),
            ]),

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
            ->row_actions([
                OrderItemsAction::make('show_order_items', __('resources.actions.order_items'))->setRoute('order.order_items')->setIcon('md-featuredplaylist-outlined')->setColor('meta-3'),
                ShowAction::make('show', __('resources.actions.show'))->setRoute('order.show')->setIcon('md-removeredeye-outlined'),

            ])
            ->table_actions([
            ]);
    }
}
