<?php

namespace App\Isap\Tables\Columns;

class ImageColumn extends Column
{
    public  $is_circle = false;
    public  $multiple = false;
    public static function make($name, $title)
    {
        return new ImageColumn($name, $title, ColumnType::IMAGE);
    }
    public function isCircle(bool $value = true)
    {
        $this->is_circle = $value;
        return $this;
    }
    public function hasMultiple(bool $value=true)
    {
        $this->multiple = $value;
        return $this;
    }
}
