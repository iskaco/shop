<?php

namespace App\Isap\Actions;

class StoreAction extends Action
{
    public static function make($name, $title)
    {
        return new StoreAction($name, $title, ActionType::STORE, ActionMethod::POST);
    }
}
