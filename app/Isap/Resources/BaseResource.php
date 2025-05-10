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

    public static function orderByLocale($array)
    {
        $locale = app()->getLocale();
        $default_locale = config('app.fallback_locale');
        uksort($array, function ($a, $b) use ($locale, $default_locale) {
            if ($a === $locale) {
                return -1;
            } elseif ($b === $locale) {
                return 1;
            } elseif ($a === $default_locale) {
                return -1;
            } elseif ($b === $default_locale) {
                return 1;
            }

            return 0;
        });
        // dd($array);
        // Extract and return only the FormSection items
        $ordered_items = [];
        foreach ($array as $item) {
            $ordered_items = array_merge($ordered_items, $item);
        }

        return $ordered_items;
    }
}
