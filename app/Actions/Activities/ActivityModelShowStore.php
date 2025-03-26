<?php

namespace App\Actions\Activities;

use App\Http\Middleware\EnsureHasPermission;
use App\Isap\Framework\GeneralConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityModelShowStore extends ActivityStore
{
    public const TITLE = 'Show a {singularName} ';
    public const DESCRIPTION = 'Show details of a {singularName} ';

    public function execute(array $data) 
    {
        $data = [
            'name' => strtr(self::TITLE, ['{singularName}' => Str::plural($data['name'])]),
            'uri' => GeneralConstants::ADMIN_PREFIX . '/' . Str::plural($data['name']) . '/{id}',
            'method' => Request::METHOD_GET,
            'action' => strtr(self::ACTION_STR, ['{singularName}' => Str::studly($data['name']), '{actionName}' => 'show']),
            'middleware' => [EnsureHasPermission::class],
            'title' => strtr(self::TITLE, ['{singularName}' => Str::plural($data['name'])]),
            'description' => strtr(self::DESCRIPTION, ['{singularName}' => Str::plural($data['name'])]),
            'icon_name' => '', //TODO add icon name
            'is_menu' => false,
            'parent_id' => 0,
            'is_active' => true,
        ];

        return parent::execute($data);

    }
}
