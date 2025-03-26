<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Models\Category;


class CategoryResource extends BaseResource
{
    protected static ?string $model = Category::class;

    public static function form(ActionType $action_type){}

    public static function table(){}
}
