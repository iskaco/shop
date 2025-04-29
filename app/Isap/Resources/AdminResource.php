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
use App\Models\Admin;
use App\Models\Role;

class AdminResource extends BaseResource
{
    protected static ?string $model = Admin::class;

    public static function form(ActionType $action_type)
    {
        $form = new Form(__('titles.admins'), Admin::class);

        return $form->components([
            FormSection::make('another_info', __('resources.admin.info'))->children([
                TextInput::make('username', __('resources.admin.username'))->isRequired()->disabledOnEdit(),
                TextInput::make('email', __('resources.admin.email'))->isEmail(),
                TextInput::make('first_name', __('resources.admin.first_name')),
                TextInput::make('last_name', __('resources.admin.last_name')),
                TextInput::make('password', __('resources.admin.password'))->isRequired()->isPassword(),
                TextInput::make('password_confirmation', __('resources.admin.password_confirmation'))->isPassword()->isRequired()->hideOnShow(),
                MultiSelectInput::make('roles', __('resources.admin.roles'))->setSource((new DataUtil)->getOptionsForModel(new Role, 'id', 'name'))->isRequired(),
                ImageInput::make('profile_image', __('resources.admin.profile_image')),
                ToggleInput::make('enable', __('resources.admin.enable')),
            ])
        ])->action(static::getAction($action_type)?->setRoute('admin.' . lcfirst($action_type->value)));
    }

    public static function table()
    {
        $table = new Table(__('resources.admin.plural'), Admin::class);

        return $table->columns([
            TextColumn::make('username', __('resources.admin.username')),
            TextColumn::make('email', __('resources.admin.email')),
            TextColumn::make('first_name', __('resources.admin.first_name')),
            TextColumn::make('last_name', __('resources.admin.last_name')),
            ImageColumn::make('profile_image', __('resources.admin.profile_image')),
            ToggleColumn::make('enable', __('resources.admin.enable')),

        ])
            ->row_actions([
                ShowAction::make('show', __('resources.actions.show'))->setRoute('admin.show')->setIcon('la-eye'),
                EditAction::make('edit', __('resources.actions.edit'))->setRoute('admin.edit')->setIcon('la-edit'),
                DeleteAction::make('delete', __('resources.actions.delete'))->hasConfirmation()->setConfirmationRoute('admin.destroy')->setConfirmationMessage(__('messages.admin.destroy.title'))->setIcon('la-trash-alt')->setColor('meta-1'),
            ])
            ->table_actions([
                CreateAction::make('create', __('resources.actions.create', ['label' => __('resources.admin.label')]))->setIcon('md-personaddalt-outlined')->setRoute('admin.create'),
            ]);
    }
}
