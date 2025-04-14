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
use App\Models\Vendor;

class VendorResource extends BaseResource
{
    protected static ?string $model = Vendor::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('resources.vendor.plural'), Vendor::class);

        return $form->components([
            ...parent::orderByLocale(
                [
                    'en' => [
                        FormSection::make('general_en', __('resources.vendor.general_en'))->children(
                            [
                                TextInput::make('name_en', __('resources.vendor.name_en'))->isRequired(),
                                TextInput::make('description_en', __('resources.vendor.description_en')),
                                TextInput::make('short_description_en', __('resources.vendor.short_description_en')),
                            ]
                        ),
                    ],
                    'ar' => [
                        FormSection::make('general_ar', __('resources.vendor.general_ar'))->children(
                            [
                                TextInput::make('name_ar', __('resources.vendor.name_ar'))->isRequired(),
                                TextInput::make('description_ar', __('resources.vendor.description_ar')),
                                TextInput::make('short_description_ar', __('resources.brand.short_description_ar')),
                            ]
                        ),
                    ],
                ]
            ),
            FormSection::make('another_info', __('resources.vendor.another_info'))->children([
                TextInput::make('slug', __('resources.vendor.slug'))->isSlug()->setRelatedSlugField('name_en')->isRequired(),
            ]),
            FormSection::make('images', __('resources.vendor.images'))->children([
                ImageInput::make('image', __('resources.vendor.image')),
                ImageInput::make('thumbnail', __('resources.vendor.thumbnail')),
                ImageInput::make('banner', __('resources.vendor.banner'))->ratio(16 / 9),
            ]),
            FormSection::make('status', __('resources.vendor.status'))->children([
                ToggleInput::make('is_active', __('resources.vendor.is_active')),
                ToggleInput::make('is_featured', __('resources.vendor.is_featured')),
            ]),
        ]
        )->action(static::getAction($action_type)?->setRoute('vendor.'.lcfirst($action_type->value)));

    }

    public static function table()
    {
        $table = new Table(__('resources.vendor.plural'), Vendor::class, 'vendors');

        return $table->columns([
            TextColumn::make('name_translated', __('resources.vendor.name')),
            TextColumn::make('slug', __('resources.vendor.slug')),
            ImageColumn::make('thumbnail', __('resources.vendor.thumbnail')),
            ToggleColumn::make('is_active', __('resources.vendor.is_active')),
            ToggleColumn::make('is_featured', __('resources.vendor.is_featured')),
        ])->row_actions([
            ShowAction::make('show', __('resources.actions.show'))->setRoute('vendor.show')->setIcon('md-removeredeye-outlined'),
            EditAction::make('edit', __('resources.actions.edit'))->setRoute('vendor.edit')->setIcon('md-modeedit-outlined'),
            DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('vendor.destroy')->setConfirmationMessage(__('messages.vendor.destroy.title'))->setIcon('md-deleteforever-outlined')->setColor('meta-1'),
        ])->table_actions([
            CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.vendor.label')]))->setIcon('md-addbox-outlined')->setRoute('vendor.create'),
        ]);
    }
}
