<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\CreateAction;
use App\Isap\Actions\DeleteAction;
use App\Isap\Actions\EditAction;
use App\Isap\Actions\ShowAction;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\ImageInput;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Components\ToggleInput;
use App\Isap\Forms\Form;
use App\Isap\Tables\Columns\ImageColumn;
use App\Isap\Tables\Columns\TextColumn;
use App\Isap\Tables\Columns\ToggleColumn;
use App\Isap\Tables\Table;
use App\Models\Brand;

class BrandResource extends BaseResource
{
    protected static ?string $model = Brand::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.brand.plural'), Brand::class);

        return $form->components(
            [
                ...parent::orderByLocale(
                    [
                        'en' => [
                            FormSection::make('general_en', __('resources.brand.general_en'))->children(
                                [
                                    TextInput::make('name_en', __('resources.brand.name_en'))->isRequired(),
                                    TextInput::make('description_en', __('resources.brand.description_en')),
                                    TextInput::make('short_description_en', __('resources.brand.short_description_en')),
                                ]
                            ),
                        ],
                        'ar' => [
                            FormSection::make('general_ar', __('resources.brand.general_ar'))->children(
                                [
                                    TextInput::make('name_ar', __('resources.brand.name_ar'))->isRequired(),
                                    TextInput::make('description_ar', __('resources.brand.description_ar')),
                                    TextInput::make('short_description_ar', __('resources.brand.short_description_ar')),
                                ]
                            ),
                        ],
                    ]
                ),
                FormSection::make('another_info', __('resources.brand.another_info'))->children([
                    TextInput::make('slug', __('resources.brand.slug'))->isSlug()->setRelatedSlugField('name_en')->isRequired(),
                ]),
                FormSection::make('images', __('resources.brand.images'))->children([
                    ImageInput::make('image', __('resources.brand.image')),
                    ImageInput::make('thumbnail', __('resources.brand.thumbnail')),
                    ImageInput::make('banner', __('resources.brand.banner'))->ratio(16 / 9),
                ]),
                FormSection::make('status', __('resources.brand.status'))->children([
                    ToggleInput::make('is_active', __('resources.brand.is_active')),
                    ToggleInput::make('is_featured', __('resources.brand.is_featured')),
                ]),
            ]
        )->action(static::getAction($action_type)?->setRoute('brand.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.product.plural'), Brand::class, 'brands');

        return $table->columns([
            TextColumn::make('name_translated', __('resources.brand.name')),
            TextColumn::make('slug', __('resources.brand.slug')),
            ImageColumn::make('thumbnail', __('resources.brand.thumbnail')),
            ToggleColumn::make('is_active', __('resources.brand.is_active')),
            ToggleColumn::make('is_featured', __('resources.brand.is_featured')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('brand.show')->setIcon('la-eye'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('brand.edit')->setIcon('la-edit'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('brand.destroy')->setConfirmationMessage(__('messages.brand.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.brand.label')]))->setIcon('md-addbox-outlined')->setRoute('brand.create'),
        ]);
    }
}
