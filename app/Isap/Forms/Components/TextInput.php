<?php

namespace App\Isap\Forms\Components;

class TextInput extends Component
{
    public $is_password = false;

    public $is_email = false;

    public $is_url = false;

    public $is_number = false;

    public $is_currency = false;

    public $is_slug = false;

    public $related_slug_field = null;

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

    public function isNumber(bool $value = true)
    {
        $this->is_number = $value;

        return $this;
    }

    public function isCurrency(bool $value = true)
    {
        $this->is_currency = $value;

        return $this;
    }

    public function isSlug(bool $value = true)
    {
        $this->is_slug = $value;

        return $this;
    }

    public function setRelatedSlugField(string $value)
    {
        $this->related_slug_field = $value;

        return $this;
    }
}
