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
use App\Models\Category;
use App\Models\Specification;

class SpecificationResource extends BaseResource
{
    protected static ?string $model = Specification::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.specification.plural'), Specification::class);
        return $form->components([
            ...parent::orderByLocale(
                [
                    'en' => [
                        FormSection::make('general_en', __('resources.specification.general_en'))->children(
                            [
                                TextInput::make('name_en', __('resources.specification.name_en'))->isRequired(),
                            ]
                        ),
                    ],
                    'ar' => [
                        FormSection::make('general_ar', __('resources.specification.general_ar'))->children(
                            [
                                TextInput::make('name_ar', __('resources.specification.name_ar'))->isRequired(),
                            ]
                        ),
                    ]
                ]
            ),
            FormSection::make('another_info', __('resources.specification.another_info'))->children([
                MultiSelectInput::make('category_id', __('resources.specification.category_id'))->setSource((new DataUtil)->getOptionsForModel(new Category, 'id', 'name'))->setIsNotMulti()->isRequired(),
                TextInput::make('input_type', __('resources.specification.input_type')),
                TextInput::make('possible_values', __('resources.specification.possible_values')),
            ]),
        ])->action(static::getAction($action_type)?->setRoute('specification.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.specification.plural'), Specification::class);
        return $table->columns([
            TextColumn::make('name_translated', __('resources.specification.name')),
            TextColumn::make('category_name', __('resources.specification.category')),
            TextColumn::make('input_type', __('resources.specification.input_type')),
            //TextColumn::make('possible_values', __('resources.specification.possible_values')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('specification.show')->setIcon('la-eye'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('specification.edit')->setIcon('la-edit'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('specification.destroy')->setConfirmationMessage(__('messages.specification.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.specification.label')]))->setRoute('specification.create')->setIcon('md-add'),
        ]);
    }
}
