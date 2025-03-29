<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Models\Brand;


class BrandResource extends BaseResource
{
    protected static ?string $model = Brand::class;

    public static function form(ActionType $action_type){}

    public static function table(){}
}
