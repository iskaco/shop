<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
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
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductResource extends BaseResource
{
    protected static ?string $model = Product::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.product.plural'), Product::class);

        return $form->components([
            ...parent::orderByLocale(
                [
                    'en' => [
                        FormSection::make('general_en', __('resources.category.general_en'))->children(
                            [
                                TextInput::make('name_en', __('resources.product.name_en'))->isRequired(),
                                TextInput::make('description_en', __('resources.product.description_en')),
                                TextInput::make('short_description_en', __('resources.product.short_description_en')),
                            ]
                        ),
                    ],
                    'ar' => [
                        FormSection::make('general_ar', __('resources.category.general_ar'))->children(
                            [
                                TextInput::make('name_ar', __('resources.product.name_ar'))->isRequired(),
                                TextInput::make('description_ar', __('resources.product.description_ar')),
                                TextInput::make('short_description_ar', __('resources.product.short_description_ar')),
                            ]
                        ),

                    ]
                ]
            ),
            FormSection::make('another_info', __('resources.product.another_info'))->children([
                TextInput::make('slug', __('resources.product.slug'))->isSlug()->setRelatedSlugField('name_en')->isRequired(),
                MultiSelectInput::make('category_id', __('resources.product.category'))->setSource((new DataUtil)->getOptionsForModel(new Category, 'id', 'name'))->setIsNotMulti()->isRequired(),
                MultiSelectInput::make('brand_id', __('resources.product.brand'))->setSource((new DataUtil)->getOptionsForModel(new Brand, 'id', 'name'))->setIsNotMulti()->isRequired(),
                TextInput::make('price', __('resources.product.price'))->isCurrency(),
                TextInput::make('stock', __('resources.product.stock'))->isNumber(),
            ]),
            FormSection::make('images', __('resources.product.images'))->children([
                ImageInput::make('image', __('resources.product.image')),
            ]),
            FormSection::make('status', __('resources.product.status'))->children([
                ToggleInput::make('is_published', __('resources.product.is_published')),
                ToggleInput::make('is_featured', __('resources.product.is_featured')),
            ]),

        ])->action(static::getAction($action_type)?->setRoute('product.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.product.plural'), Product::class);

        return $table->columns([
            TextColumn::make('name_translated', __('resources.product.name')),
            TextColumn::make('category_name', __('resources.product.category')),
            TextColumn::make('brand_name', __('resources.product.brand')),
            // TextColumn::make('description_translated', __('resources.product.description')),
            TextColumn::make('price', __('resources.product.price')),
            TextColumn::make('stock', __('resources.product.stock')),
            ImageColumn::make('image', __('resources.product.image')),
            ToggleColumn::make('is_published', __('resources.product.is_published')),
            ToggleColumn::make('is_featured', __('resources.product.is_featured')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('product.show')->setIcon('md-removeredeye-outlined'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('product.edit')->setIcon('md-modeedit-outlined'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('product.destroy')->setConfirmationMessage(__('messages.product.destroy.title'))->setIcon('md-deleteforever-outlined')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.product.label')]))->setIcon('md-addbox-outlined')->setRoute('product.create'),
        ]);
    }
}
