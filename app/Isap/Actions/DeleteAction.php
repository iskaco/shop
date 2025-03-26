<?php

namespace App\Isap\Actions;

class DeleteAction extends Action
{
    public static function make($name, $title)
    {
        return new DeleteAction($name, $title, ActionType::DELETE,ActionMethod::DELETE);
    }
}
