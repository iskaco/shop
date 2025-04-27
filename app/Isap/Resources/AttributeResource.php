<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Models\Attribute;

class AttributeResource extends BaseResource
{
    protected static ?string $model = Attribute::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.attribute.plural'), Attribute::class);

        return $form->components([
            ...parent::orderByLocale(
                [
                    'en' => [
                        FormSection::make('general_en', __('resources.attribute.general_en'))->children(
                            [
                                TextInput::make('name_en', __('resources.attribute.name_en'))->isRequired(),
                            ]
                        ),
                    ],
                    'ar' => [
                        FormSection::make('general_ar', __('resources.attribute.general_ar'))->children([
                            TextInput::make('name_ar', __('resources.attribute.name_ar'))->isRequired(),
                        ]),
                    ],
                ]
            ),
            FormSection::make('another_info', __('resources.attribute.another_info'))->children([
                TextInput::make('slug', __('resources.attribute.slug'))->isSlug()->setRelatedSlugField('name_en')->isRequired(),

            ]),

        ])->action(static::getAction($action_type)?->setRoute('attribute.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        return (new Table(__('resources.attribute.plural'), Attribute::class, 'attributes'))
            ->columns([
                TextColumn::make('name_translated', __('resources.attribute.name')),
                TextColumn::make('slug', __('resources.attribute.slug')),
            ])
            ->row_actions([
                ShowAction::make('show', __('resources.actions.show'))->setRoute('attribute.show')->setIcon('la-eye'),
                EditAction::make('edit', __('resources.actions.edit'))->setRoute('attribute.edit')->setIcon('la-edit'),
                DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('attribute.destroy')->setConfirmationMessage(__('messages.attribute.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
            ])
            ->table_actions([
                CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.attribute.label')]))->setIcon('md-addbox-outlined')->setRoute('attribute.create'),
            ]);
    }
}
