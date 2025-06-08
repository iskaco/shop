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
        $form = new Form(__('resources.{{resourceName}}.plural'), PaymentMethod::class);

        return $form->components([
            ...parent::orderByLocale([
                ...DynamicResource::createTranslatableSections('general', 'PaymentMethods', ['title', 'description']),
            ]),
            FormSection::make('general', __('resources.PaymentMethods.general'))->children([
                ToggleInput::make('is_active', __('resources.PaymentMethods.is_active')),
            ]),
        ])->action(static::getAction($action_type)?->setRoute('{{resourceName}}.'.lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.{{resourceName}}.plural'), PaymentMethod::class, '{{resourceName}}s');

        return $table->columns([
            TextColumn::make('title_translated', __('resources.PaymentMethods.title')),
            TextColumn::make('description_translated', __('resources.PaymentMethods.description')),
            ToggleColumn::make('is_active', __('resources.PaymentMethods.is_active')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('{{resourceName}}.show')->setIcon('la-eye'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('{{resourceName}}.edit')->setIcon('la-edit'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('{{resourceName}}.destroy')->setConfirmationMessage(__('messages.{{resourceName}}.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.{{resourceName}}.label')]))->setIcon('md-addbox-outlined')->setRoute('{{resourceName}}.create'),
        ]);
    }
}
