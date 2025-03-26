<?php

namespace App\Actions\Menus;

use App\Actions\BaseAction;
use App\Models\Menu;


class MenuIndex extends BaseAction
{
    public function execute(/*array $data*/) /* return value */
    {
        return Menu::all();
    }
}
