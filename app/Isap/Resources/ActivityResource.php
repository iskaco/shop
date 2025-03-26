<?php

namespace App\Isap\Resources;

use App\Models\Activity;


class ActivityResource extends BaseResource
{
    protected static ?string $model = Activity::class;

    public static function form(){}

    public static function table(){}
}
