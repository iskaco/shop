<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\ImageInput;
use App\Isap\Forms\Components\MultiSelectInput;
use App\Isap\Forms\Components\SelectInput;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Table;
use App\Isap\Utils\DataUtil;
use App\Models\Category;
use App\Models\Product;


class ProductResource extends BaseResource
{
    protected static ?string $model = Product::class;

    public static function form(ActionType $action_type){
        $form = new Form(__('resources.product.plural'), Product::class);

        return $form->components([
            TextInput::make('name_en', __('resources.product.name_en'))->isRequired(),
            TextInput::make('name_ar', __('resources.product.name_ar'))->isRequired(),
            MultiSelectInput::make('category_id', __('resources.product.category'))->setSource((new DataUtil)->getOptionsForModel(new Category, 'id', 'name'))->setIsNotMulti()->isRequired(),
            TextInput::make('description_en', __('resources.product.description_en')),
            TextInput::make('description_ar', __('resources.product.description_ar')),
            TextInput::make('price', __('resources.product.price')),
            ImageInput::make('image', __('resources.product.image')),
        ])->action(static::getAction($action_type)?->setRoute('product.' . lcfirst($action_type->value)));;
    }

    public static function table(){
        $table = new Table(__('resources.product.plural'), Product::class);

        return $table->columns([
            TextColumn::make('name', __('resources.product.name')),
            TextColumn::make('category',__('resources.product.category')),
            TextColumn::make('description', __('resources.product.description')),
            TextColumn::make('price', __('resources.product.price')),
            TextColumn::make('stock', __('resources.product.stock')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('product.show')->setIcon('md-removeredeye-outlined'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('product.edit')->setIcon('md-modeedit-outlined'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('product.destroy')->setConfirmationMessage(__('messages.product.destroy'))->setIcon('md-deleteforever-outlined')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.product.label')]))->setIcon('md-addbox-outlined')->setRoute('product.create'),
        ]);
    }
}
