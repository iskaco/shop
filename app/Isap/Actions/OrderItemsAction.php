<?php

namespace App\Isap\Actions;

class OrderItemsAction extends Action
{
    public static function make($name, $title)
    {
        return new OrderItemsAction($name, $title, ActionType::SHOW, ActionMethod::GET);
    }
}
