<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\ToggleInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Columns\ToggleColumn;
use App\Isap\Tables\Table;
use App\Models\PaymentMethod;

class PaymentMethodResource extends BaseResource
{
    protected static ?string $model = PaymentMethod::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.payment_method.plural'), PaymentMethod::class);

        return $form->components([
            ...parent::orderByLocale([
                ...DynamicResource::createTranslatableSections('general', 'PaymentMethods', ['title', 'description']),
            ]),
            FormSection::make('general', __('resources.payment_method.general'))->children([
                ToggleInput::make('is_active', __('resources.payment_method.is_active')),
            ]),
        ])->action(static::getAction($action_type)?->setRoute('payment_method.'.lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.payment_method.plural'), PaymentMethod::class, 'payment_methods');

        return $table->columns([
            TextColumn::make('title_translated', __('resources.payment_method.title')),
            TextColumn::make('description_translated', __('resources.payment_method.description')),
            ToggleColumn::make('is_active', __('resources.payment_method.is_active')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('payment_method.show')->setIcon('la-eye'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('payment_method.edit')->setIcon('la-edit'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('payment_method.destroy')->setConfirmationMessage(__('messages.payment_method.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.payment_method.label')]))->setIcon('md-addbox-outlined')->setRoute('payment_method.create'),
        ]);
    }
}
