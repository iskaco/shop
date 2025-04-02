<?php

namespace App\Isap\Forms\Components;

class ImageInput extends Component
{
    public $ratio = 1 / 1;
    public static function make($name,  $title)
    {
        return (new ImageInput($name, $title, ComponentType::IMAGE));
    }
    public function ratio(float $value)
    {
        $this->ratio = $value;
        return $this;
    }
}
