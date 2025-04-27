<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Components\ToggleInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Columns\ToggleColumn;
use App\Isap\Tables\Table;
use App\Models\Tax;


class TaxResource extends BaseResource
{
    protected static ?string $model = Tax::class;

    public static function form(ActionType $action_type)
    {

        $form = new Form(__('resources.tax.plural'), Tax::class);

        return $form->components([
            ...parent::orderByLocale(
                [
                    'en' => [
                        FormSection::make('general_en', __('resources.category.general_en'))->children(
                            [
                                TextInput::make('name_en', __('resources.tax.name_en'))->isRequired(),
                            ]
                        ),
                    ],
                    'ar' => [
                        FormSection::make('general_ar', __('resources.category.general_ar'))->children(
                            [
                                TextInput::make('name_ar', __('resources.tax.name_ar'))->isRequired(),
                            ]
                        ),

                    ]
                ]
            ),
            FormSection::make('tax_info', __('resources.product.another_info'))->children([
                TextInput::make('rate', __('resources.tax.rate'))->isRequired()
            ]),
            FormSection::make('status', __('resources.product.status'))->children([
                ToggleInput::make('is_active', __('resources.tax.is_active')),
            ]),

        ])->action(static::getAction($action_type)?->setRoute('tax.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.tax.plural'), Tax::class, 'taxes');

        return $table->columns([
            TextColumn::make('name_translated', __('resources.tax.name')),
            TextColumn::make('rate', __('resources.tax.rate')),
            ToggleColumn::make('is_active', __('resources.tax.is_active')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('tax.show')->setIcon('la-eye'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('tax.edit')->setIcon('la-edit'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('tax.destroy')->setConfirmationMessage(__('messages.tax.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.tax.label')]))->setIcon('md-addbox-outlined')->setRoute('tax.create'),
        ]);
    }
}
