<?php

namespace App\Isap\Forms;

use App\Isap\Actions\Action;

class Form
{
    public $components = [];
    public $action = null;
    public function __construct(public $title = '', public $model='') {}
    public function components(?array $components)
    {
        $this->components = $components;
        return $this;
    }

    public function action(?Action $action)
    {
        $this->action = $action;
        return $this;
    }
}
