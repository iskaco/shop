<?php

namespace App\Isap\Forms\Components;

class FormSection extends Component
{
    public $is_collapsible = false;
    public $children = [];
    public static function make($name, $title): FormSection
    {
        return new FormSection($name, $title, ComponentType::SECTION);
    }

    public function isCollapsible(bool $value = true): FormSection
    {
        $this->is_collapsible = $value;

        return $this;
    }

    public function children(?array $children): FormSection
    {
        $this->children = $children;

        return $this;
    }
}
