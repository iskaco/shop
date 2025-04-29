<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Actions\ShowProducts;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\IconInput;
use App\Isap\Forms\Components\ImageInput;
use App\Isap\Forms\Components\MultiSelectInput;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Components\ToggleInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\ImageColumn;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Columns\ToggleColumn;
use App\Isap\Tables\Table;
use App\Isap\Utils\DataUtil;
use App\Models\Category;

class CategoryResource extends BaseResource
{
    protected static ?string $model = Category::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.category.plural'), Category::class);

        return $form->components([
            ...parent::orderByLocale(
                [
                    'en' => [
                        FormSection::make('general_en', __('resources.category.general_en'))->children(
                            [
                                TextInput::make('name_en', __('resources.category.name_en'))->isRequired(),
                                TextInput::make('description_en', __('resources.category.description_en')),
                            ]
                        ),
                    ],
                    'ar' => [
                        FormSection::make('general_ar', __('resources.category.general_ar'))->children([
                            TextInput::make('name_ar', __('resources.category.name_ar'))->isRequired(),
                            TextInput::make('description_ar', __('resources.category.description_ar')),
                        ]),
                    ],
                ]
            ),
            FormSection::make('another_info', __('resources.category.another_info'))->children([
                MultiSelectInput::make('parent_id', __('resources.category.parent'))->setSource((new DataUtil)->getOptionsForModel(new Category, 'id', 'name'))->setIsNotMulti(),
                TextInput::make('slug', __('resources.category.slug'))->isSlug()->setRelatedSlugField('name_en')->isRequired(),
                IconInput::make('icon', __('resources.category.icon')),

            ]),
            FormSection::make('images', __('resources.category.images'))->children([
                ImageInput::make('thumbnail', __('resources.category.thumbnail')),
                ImageInput::make('image', __('resources.category.image')),
                ImageInput::make('banner', __('resources.category.banner'))->ratio(16 / 9),
            ]),
            FormSection::make('status', __('resources.category.status'))->children([
                ToggleInput::make('is_active', __('resources.category.is_active')),
                ToggleInput::make('is_featured', __('resources.product.is_featured')),
            ]),

        ])->action(static::getAction($action_type)?->setRoute('category.' . lcfirst($action_type->value)));
        // dd($form);
    }

    public static function table()
    {
        return (new Table(__('resources.category.plural'), Category::class, 'categories'))
            ->columns([
                TextColumn::make('name_translated', __('resources.category.name')),
                TextColumn::make('parent_name', __('resources.category.parent')),
                TextColumn::make('slug', __('resources.category.slug')),
                ImageColumn::make('thumbnail', __('resources.category.thumbnail')),
                ToggleColumn::make('is_active', __('resources.category.is_active')),
            ])
            ->row_actions([
                ShowProducts::make('show_products', __('resources.actions.show_category_products'))->setRoute('category.products')->setIcon('la-poll-h-solid')->setColor('meta-3'),
                ShowAction::make('show', __('resources.actions.show'))->setRoute('category.show')->setIcon('la-eye'),
                EditAction::make('edit', __('resources.actions.edit'))->setRoute('category.edit')->setIcon('la-edit'),
                DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('category.destroy')->setConfirmationMessage(__('messages.category.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
            ])
            ->table_actions([
                CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.category.label')]))->setIcon('md-addbox-outlined')->setRoute('category.create'),
            ]);
    }
}
