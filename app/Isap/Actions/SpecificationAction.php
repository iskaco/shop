<?php

namespace App\Isap\Actions;

class SpecificationAction extends Action
{
    public static function make($name, $title)
    {
        return new SpecificationAction($name, $title, ActionType::EDIT, ActionMethod::GET);
    }
}
