<?php

namespace App\Isap\Forms\Components;

class IconInput extends Component
{
    public static function make($name, $title)
    {
        return new IconInput($name, $title, ComponentType::ICON);
    }
}
