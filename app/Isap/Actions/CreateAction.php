<?php

namespace App\Isap\Actions;

class CreateAction extends Action
{
    public static function make($name, $title)
    {
        return new CreateAction($name, $title, ActionType::CREATE,ActionMethod::GET);
    }
}
