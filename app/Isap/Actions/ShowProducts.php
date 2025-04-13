<?php

namespace App\Isap\Actions;

class ShowProducts extends Action
{
    public static function make($name, $title)
    {
        return new ShowProducts($name, $title, ActionType::SHOW, ActionMethod::GET);
    }
}
