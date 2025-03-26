<?php

namespace App\Isap\Tables\Columns;

class ToggleColumn extends Column
{
    public static function make($name, $title)
    {
        return new ToggleColumn($name, $title, ColumnType::TOGGLE);
    }
}
