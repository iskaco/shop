<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\DeleteAction;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Models\Cart;


class CartResource extends BaseResource
{
    protected static ?string $model = Cart::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.order.plural'), Cart::class);

        return $form->components([])->action(static::getAction($action_type)?->setRoute('cart.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        return (new Table(__('resources.oorder.plural'), Cart::class))
            ->columns([
                TextColumn::make('user_name', __('resources.cart.user_name')),
            ])
            ->row_actions([
                DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('category.destroy')->setConfirmationMessage(__('messages.category.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
            ])
            ->table_actions([]);
    }
}
