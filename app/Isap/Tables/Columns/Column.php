<?php

namespace App\Isap\Tables\Columns;

abstract class Column
{
    public $model_column;
    public $sortable = false;

    public function __construct(public $name, public $title, public $column_type)
    {
        $this->model_column = $this->name;
    }
    abstract public static function make($name, $title);

    public function sortable(bool $value = true)
    {
        $this->sortable = $value;
        return $this;
    }
    public function setModelColumn(string $value)
    {
        $this->model_column = $value;
        return $this;
    }
}
