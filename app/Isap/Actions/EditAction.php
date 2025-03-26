<?php

namespace App\Isap\Actions;

class EditAction extends Action
{
    public static function make($name, $title)
    {
        return new EditAction($name, $title, ActionType::EDIT,ActionMethod::GET);
    }
}
