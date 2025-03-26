<?php

namespace App\Isap\Resources;

use App\Models\Permission;


class PermissionResource extends BaseResource
{
    protected static ?string $model = Permission::class;

    public static function form(){}

    public static function table(){}
}
