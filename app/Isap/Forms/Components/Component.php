<?php

namespace App\Isap\Forms\Components;

abstract class Component
{
    public $rules = [];
    public $required = false;
    public $hideOnShow = false;
    public $hideOnEdit = false;
    public $hideOnCreate = false;
    public $disabledOnShow = true;
    public $disabledOnEdit = false;
    public function __construct(public $name, public $title, public $component_type) {}
    abstract public static function make(string $name, string $title);
    public function setRules(array $value = [])
    {
        $this->rules = $value;
        return $this;
    }
    public function isRequired(bool $value = true)
    {
        $this->required = $value;
        return $this;
    }

    public function hideOnShow($callback = true): Component
    {
        $this->hideOnShow = is_callable($callback) ? function () use ($callback) {
            return !call_user_func_array($callback, func_get_args());
        }
            : $callback;

        return $this;
    }

    public function hideOnEdit($callback = true): Component
    {
        $this->hideOnEdit = is_callable($callback) ? function () use ($callback) {
            return !call_user_func_array($callback, func_get_args());
        }
            : $callback;

        return $this;
    }

    public function hideOnCreate($callback = true): Component
    {
        $this->hideOnCreate = is_callable($callback) ? function () use ($callback) {
            return !call_user_func_array($callback, func_get_args());
        }
            : $callback;

        return $this;
    }

    public function disabledOnShow($callback = true): Component
    {
        $this->disabledOnShow = is_callable($callback) ? function () use ($callback) {
            return !call_user_func_array($callback, func_get_args());
        }
            : $callback;

        return $this;
    }

    public function disabledOnEdit($callback = true): Component
    {
        $this->disabledOnEdit = is_callable($callback) ? function () use ($callback) {
            return !call_user_func_array($callback, func_get_args());
        }
            : $callback;

        return $this;
    }
}
