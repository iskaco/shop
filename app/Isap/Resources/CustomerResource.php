<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Models\Customer;


class CustomerResource extends BaseResource
{
    protected static ?string $model = Customer::class;

    public static function form(ActionType $action_type){}

    public static function table(){}
}
