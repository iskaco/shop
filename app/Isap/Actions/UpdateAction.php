<?php

namespace App\Isap\Actions;

class UpdateAction extends Action
{
    public static function make($name, $title)
    {
        return new UpdateAction($name, $title, ActionType::UPDATE, ActionMethod::PUT);
    }
}
