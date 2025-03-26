<?php

namespace App\Isap\Forms\Components;

class SelectInput extends Component
{
    public $source = [];
    public static function make($name, $title)
    {
        return new SelectInput($name, $title, ComponentType::COMBO);
    }
    public function setSource(array $value)
    {
        $this->source = $value;
        return $this;
    }
}
