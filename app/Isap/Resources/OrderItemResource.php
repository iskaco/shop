<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\MultiSelectInput;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Isap\Utils\DataUtil;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemResource extends BaseResource
{
    protected static ?string $model = OrderItem::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.order_item.plural'), OrderItem::class);

        /*'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'unit_cost',
        'options',*/
        return $form->components([
            FormSection::make('another_info', __('resources.order_item.info'))->children([
                MultiSelectInput::make('product_id', __('resources.order_item.product'))->setSource((new DataUtil)->getOptionsForModel(new Product, 'id', 'name'))->setIsNotMulti(),
                TextInput::make('quantity', __('resources.order_item.quantity'))->isRequired(),
                TextInput::make('unit_price', __('resources.order_item.unit_price'))->isRequired(),
                TextInput::make('unit_cost', __('resources.order_item.unit_cost'))->isRequired(),
                TextInput::make('options', __('resources.order_item.options'))->isRequired(),
            ]),

        ])->action(static::getAction($action_type)?->setRoute('order_item.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        return (new Table(__('resources.order_item.plural'), OrderItem::class))
            ->columns([
                TextColumn::make('product_name', __('resources.order_item.product_name')),
                TextColumn::make('quantity', __('resources.order_item.quantity')),
                TextColumn::make('unit_price', __('resources.order_item.unit_price')),
                TextColumn::make('unit_cost', __('resources.order_item.unit_cost')),

            ])
            ->row_actions([
                ShowAction::make('show', __('resources.actions.show'))->setRoute('order_item.show')->setIcon('la-eye'),

            ])
            ->table_actions([]);
    }
}
