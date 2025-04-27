<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\MultiSelectInput;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Isap\Utils\DataUtil;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueResource extends BaseResource
{
    protected static ?string $model = AttributeValue::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.attribute_value.plural'), AttributeValue::class);

        return $form->components([

            FormSection::make('attribute', __('resources.attribute_value.attribute'))->children(
                [MultiSelectInput::make('attribute_id', __('resources.attribute_value.attribute'))->setSource((new DataUtil)->getOptionsForModel(new Attribute, 'id', 'name'))->isRequired()->setIsNotMulti()]
            ),
            ...parent::orderByLocale(
                [
                    'en' => [
                        FormSection::make('general_en', __('resources.attribute_value.general_en'))->children(
                            [
                                TextInput::make('value_en', __('resources.attribute_value.value_en'))->isRequired(),
                            ]
                        ),
                    ],
                    'ar' => [
                        FormSection::make('general_ar', __('resources.attribute_value.general_ar'))->children([
                            TextInput::make('value_ar', __('resources.attribute_value.value_ar'))->isRequired(),
                        ]),
                    ],
                ]
            ),
            FormSection::make('info', __('resources.attribute_value.another_info'))->children([
                // TextInput::make('value', __('resources.attribute_value.value'))->isRequired(),
                TextInput::make('code', __('resources.attribute_value.code')),

            ]),

        ])->action(static::getAction($action_type)?->setRoute('attribute_value.' . lcfirst($action_type->value)));
    }

    public static function table()
    {

        return (new Table(__('resources.attribute_value.plural'), AttributeValue::class, 'attribute_values'))
            ->columns([
                TextColumn::make('attribute_name', __('resources.attribute_value.attribute')),
                TextColumn::make('value_translated', __('resources.attribute_value.value')),
                TextColumn::make('code', __('resources.attribute_value.code')),

            ])
            ->row_actions([
                ShowAction::make('show', __('resources.attribute_value.show'))->setRoute('attribute_value.show')->setIcon('la-eye'),
                EditAction::make('edit', __('resources.attribute_value.edit'))->setRoute('attribute_value.edit')->setIcon('la-edit'),
                DeleteAction::make('delete', __('resources.attribute_value.delete'))->hasConfirmation()->setConfirmationRoute('attribute_value.destroy')->setConfirmationMessage(__('messages.attribute_value.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
            ])
            ->table_actions([
                CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.attribute_value.label')]))->setIcon('md-addbox-outlined')->setRoute('attribute_value.create'),
            ]);
    }
}
