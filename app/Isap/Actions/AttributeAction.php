<?php

namespace App\Isap\Actions;

class AttributeAction extends Action
{
    public static function make($name, $title)
    {
        return new AttributeAction($name, $title, ActionType::EDIT, ActionMethod::GET);
    }
}
