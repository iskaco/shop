<?php

namespace App\Isap\Tables;

use App\Isap\Tables\Columns\Column;

class Table
{

    public $columns = [];
    public $filters = [];
    public $row_actions = [];
    public $table_actions = [];
    public function __construct(public $title = '', public $model = '', public $name = '') {}
    public function columns(?array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function filters(?array  $filters)
    {
        $this->columns = $filters;
        return $this;
    }

    public function row_actions(?array $actions)
    {
        $this->row_actions = $actions;
        return $this;
    }

    public function table_actions(?array $actions)
    {
        $this->table_actions = $actions;
        return $this;
    }
}
