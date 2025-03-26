<?php

namespace App\Isap\Actions;

abstract class Action
{
    public $icon = '';
    public $route = null;
    public $has_label = false;
    public $color = 'primary';
    public $has_confirmation = false;
    public $confirmation_route = null;
    public $confirmation_message = null;
    public function __construct(public $name = '', public $title = '', public $action_type = '',public $action_method='') {}
    abstract public static function make($name, $title);

    public function setRoute(string $value)
    {
        $this->route = $value;
        return $this;
    }
    public function setIcon(string $value)
    {
        $this->icon = $value;
        return $this;
    }
    public function hasLabel(bool $value = true)
    {
        $this->has_label = $value;
        return $this;
    }

    public function setColor(string $value)
    {
        $this->color = $value;
        return $this;
    }

    public function hasConfirmation(bool $value = true)
    {
        $this->has_confirmation = $value;
        return $this;
    }

    public function setConfirmationRoute(string $value)
    {
        $this->confirmation_route = $value;
        return $this;
    }

    public function setConfirmationMessage(string $value)
    {
        $this->confirmation_message = $value;
        return $this;
    }
}
