<?php

namespace App\Isap\Resources;

use App\Isap\Actions\ActionType;
use App\Isap\Actions\StoreAction;
use App\Isap\Actions\UpdateAction;

abstract class BaseResource
{
    abstract public static function form(ActionType $action_type);

    abstract public static function table();

    protected static function getAction($action_type)
    {
        $action = null;
        switch ($action_type) {
            case ActionType::UPDATE:
                $action = (new UpdateAction)::make('Update', __('resources.actions.update'));
                break;
            case ActionType::STORE:
                $action = (new StoreAction)::make('Store', __('resources.actions.store'));
                break;
            default:
                // code...
                break;
        }

        return $action;
    }
}
