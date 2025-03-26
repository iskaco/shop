<?php

namespace App\Isap\Forms\Components;

class TextInput extends Component
{
    public $is_password = false;
    public $is_email = false;
    public $is_url = false;
    public static function make($name, $title)
    {
        return new TextInput($name, $title, ComponentType::TEXT);
    }

    public function isPassword(bool $value = true)
    {
        $this->is_password = $value;
        return $this;
    }

    public function isEmail(bool $value = true)
    {
        $this->is_email = $value;
        return $this;
    }

    public function isUrl(bool $value = true)
    {
        $this->is_url = $value;
        return $this;
    }
}
