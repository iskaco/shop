<?php

namespace App\Isap\Actions;

class ShowAction extends Action
{
    public static function make($name, $title)
    {
        return new ShowAction($name, $title, ActionType::SHOW,ActionMethod::GET);
    }
}
