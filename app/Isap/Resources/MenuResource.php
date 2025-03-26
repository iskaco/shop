<?php

namespace App\Isap\Resources;

use App\Models\Menu;


class MenuResource extends BaseResource
{
    protected static ?string $model = Menu::class;

    public static function form()
    {
        return [];
    }

    public static function table()
    {
        return [];
    }
}
