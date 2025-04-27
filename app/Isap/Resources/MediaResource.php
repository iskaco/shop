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
use App\Models\MediaInfo;

class MediaResource extends BaseResource
{
    protected static ?string $model = MediaInfo::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.media.plural'), MediaInfo::class);

        return $form->components([

            FormSection::make('info', __('resources.media.info'))->children([
                TextInput::make('brand_id', __('resources.product.brand'))->setSource((new DataUtil)->getOptionsForModel(new Brand, 'id', 'name'))->setIsNotMulti()->isRequired(),
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
        $table = new Table(__('resources.product.plural'), Product::class, 'products');

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
            ShowAction::make('show', __('resources.actions.show'))->setRoute('product.show')->setIcon('la-eye'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('product.edit')->setIcon('la-edit'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('product.destroy')->setConfirmationMessage(__('messages.product.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.product.label')]))->setIcon('md-addbox-outlined')->setRoute('product.create'),
        ]);
    }
}
