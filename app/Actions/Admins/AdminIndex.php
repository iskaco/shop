<?php

namespace App\Actions\Admins;

use App\Actions\BaseAction;
use App\Models\Admin;


class AdminIndex extends BaseAction
{
    public function execute() /* return value */
    {
        return Admin::all();
    }
}
