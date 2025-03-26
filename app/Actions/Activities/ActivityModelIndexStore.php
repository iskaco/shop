<?php

namespace App\Actions\Activities;

use App\Http\Middleware\EnsureHasPermission;
use App\Isap\Framework\GeneralConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityModelIndexStore extends ActivityStore
{
    public const TITLE = 'Get list of {pluralName} ';
    public const DESCRIPTION = 'Get list of {pluralName} to edit and delete';

    public function execute(array $data) 
    {
        $data = [
            'name' => strtr(self::TITLE, ['{pluralName}' => Str::plural($data['name'])]),
            'uri' => GeneralConstants::ADMIN_PREFIX . '/' . Str::plural($data['name']),
            'method' => Request::METHOD_GET,
            'action' => strtr(self::ACTION_STR, ['{singularName}' => Str::studly($data['name']), '{actionName}' => 'index']),
            'middleware' => [EnsureHasPermission::class],
            'title' => strtr(self::TITLE, ['{pluralName}' => Str::plural($data['name'])]),
            'description' => strtr(self::DESCRIPTION, ['{pluralName}' => Str::plural($data['name'])]),
            'icon_name' => '', //TODO add icon name
            'is_menu' => true,
            'parent_id' => 0,
            'is_active' => true,
        ];

        return parent::execute($data);

    }
}
