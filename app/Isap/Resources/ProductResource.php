<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\AttributeAction;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Actions\SpecificationAction;
use App\Isap\Actions\VariantAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\GalleryInput;
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
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;

class ProductResource extends BaseResource
{
    protected static ?string $model = Product::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.product.plural'), Product::class);

        return $form->components([
            ...parent::orderByLocale(
                [
                    ...DynamicResource::createTranslatableSections('general', 'product', ['name', 'description', 'short_description']),

                ]
            ),
            FormSection::make('another_info', __('resources.product.another_info'))->children([
                TextInput::make('slug', __('resources.product.slug'))->isSlug()->setRelatedSlugField('name_en')->isRequired(),
                MultiSelectInput::make('category_id', __('resources.product.category'))->setSource((new DataUtil)->getOptionsForModel(new Category, 'id', 'name', ['is_active' => 1]))->setIsNotMulti()->isRequired(),
                MultiSelectInput::make('brand_id', __('resources.product.brand'))->setSource((new DataUtil)->getOptionsForModel(new Brand, 'id', 'name'))->setIsNotMulti()->isRequired(),
                MultiSelectInput::make('vendor_id', __('resources.product.vendor'))->setSource((new DataUtil)->getOptionsForModel(new Vendor, 'id', 'name'))->setIsNotMulti(),
                TextInput::make('cost', __('resources.product.cost'))->isCurrency(),
                TextInput::make('price', __('resources.product.price'))->isCurrency(),
                TextInput::make('stock', __('resources.product.stock'))->isNumber(),
            ]),
            /* FormSection::make('stock', __('resources.product.stock'))->children([
                TextInput::make('stock_zone', __('resources.product.stock_zone')),
                TextInput::make('')
            ]),*/
            FormSection::make('attribute', __('resources.product.attributes'))->children([
                MultiSelectInput::make('attributes_id', __('resources.product.attributes'))->setSource((new DataUtil)->getOptionsForModel(new Attribute, 'id', 'name')),
            ]),
            FormSection::make('images', __('resources.product.images'))->children([
                ImageInput::make('image', __('resources.product.image')),
                GalleryInput::make('gallery', __('resources.product.gallery')),

            ]),
            FormSection::make('status', __('resources.product.status'))->children([
                ToggleInput::make('is_published', __('resources.product.is_published')),
                ToggleInput::make('is_featured', __('resources.product.is_featured')),
            ]),

        ])->action(static::getAction($action_type)?->setRoute('product.'.lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.product.plural'), Product::class, 'products');

        return $table->columns([
            TextColumn::make('name_translated', __('resources.product.name')),
            TextColumn::make('category_name', __('resources.product.category')),
            TextColumn::make('brand_name', __('resources.product.brand')),
            TextColumn::make('vendor_name', __('resources.product.vendor')),
            // TextColumn::make('description_translated', __('resources.product.description')),
            // TextColumn::make('cost', __('resources.product.cost')),
            TextColumn::make('price', __('resources.product.price')),
            // TextColumn::make('stock', __('resources.product.stock')),
            ImageColumn::make('image', __('resources.product.image')),
            ToggleColumn::make('is_published', __('resources.product.is_published')),
            ToggleColumn::make('is_featured', __('resources.product.is_featured')),
        ])->row_actions([
            VariantAction::make('show_variant', __('resources.actions.show_variants', ['label' => __('resources.product_variant.label')]))->setRoute('product.variants')->setIcon('la-shapes-solid')->setColor('meta-6'),
            AttributeAction::make('show_attribute', __('resources.actions.product', ['label' => __('resources.attribute.label')]))->setRoute('product.attributes')->setIcon('la-shapes-solid')->setColor('meta-5'),
            SpecificationAction::make('show_specification', __('resources.actions.product', ['label' => __('resources.specification.label')]))->setRoute('product.specifications')->setIcon('la-poll-h-solid')->setColor('meta-3'),
            ShowAction::make('show', __('resources.actions.show'))->setRoute('product.show')->setIcon('la-eye'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('product.edit')->setIcon('la-edit'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('product.destroy')->setConfirmationMessage(__('messages.product.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.product.label')]))->setIcon('md-addbox-outlined')->setRoute('product.create'),
        ]);
    }
}
