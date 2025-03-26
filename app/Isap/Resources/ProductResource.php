<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Models\Product;


class ProductResource extends BaseResource
{
    protected static ?string $model = Product::class;

    public static function form(ActionType $action_type){}

    public static function table(){
        $table = new Table(__('resources.product.plural'), Product::class);

        return $table->columns([
            TextColumn::make('name', __('resources.product.name')),
            TextColumn::make('description', __('resources.product.description')),
            TextColumn::make('price', __('resources.product.price')),
            TextColumn::make('stock', __('resources.product.stock')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('product.show')->setIcon('md-removeredeye-outlined'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('product.edit')->setIcon('md-modeedit-outlined'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('product.destroy')->setConfirmationMessage(__('messages.product.destroy'))->setIcon('md-deleteforever-outlined')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.product.label')]))->setIcon('md-personaddalt-outlined')->setRoute('product.create'),
        ]);
    }
}
