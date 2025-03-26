<?php

namespace App\Isap\Tables\Columns;

class BadgeColumn extends Column
{
    public $ui_attribute = null;
    public static function make($name, $title)
    {
        return new BadgeColumn($name, $title, ColumnType::BADGE);
    }

    public function setUiAttribute($value)
    {
        $this->ui_attribute = $value;
        return $this;
    }
}
