<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\ImageInput;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Components\ToggleInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\ImageColumn;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Columns\ToggleColumn;
use App\Isap\Tables\Table;
use App\Models\Customer;

class CustomerResource extends BaseResource
{
    protected static ?string $model = Customer::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.customer.plural'), Customer::class);

        return $form->components([

            FormSection::make('', '')->children([
                TextInput::make('name', __('resources.customer.name')),
                TextInput::make('email', __('resources.customer.email')),
                TextInput::make('mobile', __('resources.customer.mobile')),
            ]),
            FormSection::make('address', __('resources.customer.address'))->children([
                TextInput::make('address', __('resources.customer.mobile')),
                TextInput::make('city', __('resources.customer.mobile')),
                TextInput::make('country', __('resources.customer.mobile')),
                TextInput::make('postal_code', __('resources.customer.mobile')),
            ]),
            FormSection::make('images', __('resources.customer.images'))->children([
                ImageInput::make('image', __('resources.customer.image')),
            ]),
            FormSection::make('status', __('resources.customer.status'))->children([
                ToggleInput::make('enable', __('resources.customer.status')),
            ]),

        ])->action(static::getAction($action_type)?->setRoute('customer.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.customer.plural'), Customer::class, 'customers');

        return $table->columns([
            TextColumn::make('name', __('resources.customer.name')),
            TextColumn::make('email', __('resources.customer.email')),
            TextColumn::make('mobile', __('resources.customer.mobile')),
            ImageColumn::make('profile_image', __('resources.customer.profile_image')),
            ToggleColumn::make('enable', __('resources.customer.enable')),
        ])->row_actions([
            // SpecificationAction::make('show_specification', __('resources.actions.product', ['label' => __('resources.specification.label')]))->setRoute('product.specifications')->setIcon('la-poll-h-solid')->setColor('meta-3'),
            ShowAction::make('showProduct', __('resources.actions.show_orders'))->setRoute('customer.orders')->setIcon('la-poll-h-solid')->setColor('meta-3'),
            ShowAction::make('show', __('resources.actions.show'))->setRoute('customer.show')->setIcon('la-eye'),
            // EditAction::make('edit', __('resources.actions.edit'))->setRoute('product.edit')->setIcon('la-edit'),
            // DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('product.destroy')->setConfirmationMessage(__('messages.product.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            // CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.product.label')]))->setIcon('md-addbox-outlined')->setRoute('product.create'),
        ]);
    }
}
