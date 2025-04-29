<?php

namespace App\Isap\Actions;

class VariantAction extends Action
{
    public static function make($name, $title)
    {
        return new VariantAction($name, $title, ActionType::EDIT, ActionMethod::GET);
    }
}
