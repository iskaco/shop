<?php

namespace App\Isap\Forms\Components;

class ToggleInput extends Component
{
    public static function make($name, $title)
    {
        return new ToggleInput($name, $title, ComponentType::TOGGLE);
    }
}
