<?php

namespace App\Isap\Forms\Components;

class MultiSelectInput extends Component
{
    public $source = [];
    public $is_multi = true;
    public static function make($name, $title)
    {
        return new MultiSelectInput($name, $title, ComponentType::MULTISELECT);
    }
    public function setSource(array $value)
    {
        $this->source = $value;
        return $this;
    }
    public function setIsNotMulti()
    {
        $this->is_multi = false;
        return $this;
    }
}
