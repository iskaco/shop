<?php

namespace App\Isap\Tables\Columns;

class TextColumn extends Column
{
    public $is_password = false;

    public $is_email = false;

    public $is_url = false;

    public $prefix = null;

    public $postfix = null;

    public static function make($name, $title)
    {
        return new TextColumn($name, $title, ColumnType::TEXT);
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

    public function setPrefix(string $value = '')
    {
        $this->prefix = $value;

        return $this;
    }

    public function setPostfix(string $value = '')
    {
        $this->postfix = $value;

        return $this;
    }
}
