<?php

namespace App\Actions\Activities;

use App\Http\Middleware\EnsureHasPermission;
use App\Isap\Framework\GeneralConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityModelStoreStore extends ActivityStore
{
    public const TITLE = 'Create new instance of {singularName} ';
    public const DESCRIPTION = 'Create new instance of {singularName} in DB.';

    public function execute(array $data) 
    {
        $data = [
            'name' => strtr(self::TITLE, ['{singularName}' => Str::plural($data['name'])]),
            'uri' => GeneralConstants::ADMIN_PREFIX . '/' . Str::plural($data['name']),
            'method' => Request::METHOD_POST,
            'action' => strtr(self::ACTION_STR, ['{singularName}' => Str::studly($data['name']), '{actionName}' => 'store']),
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
