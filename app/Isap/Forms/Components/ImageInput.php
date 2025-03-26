<?php

namespace App\Isap\Forms\Components;

class ImageInput extends Component
{
    public static function make($name,  $title)
    {
        return (new ImageInput($name, $title, ComponentType::IMAGE));
    }
}
