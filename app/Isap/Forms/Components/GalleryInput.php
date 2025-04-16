<?php

namespace App\Isap\Forms\Components;

class GalleryInput extends Component
{
    public $ratio = 1 / 1;

    public static function make($name, $title)
    {
        return new GalleryInput($name, $title, ComponentType::GALLERY);
    }

    public function ratio(float $value)
    {
        $this->ratio = $value;

        return $this;
    }
}
