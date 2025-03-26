<?php

namespace App\Isap\Forms\Components;

class FileInput extends Component
{
    public static function make($name, $title)
    {
        return (new FileInput($name, $title, ComponentType::FILE));
    }
}
