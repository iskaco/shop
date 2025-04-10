<?php

namespace App\Isap\Resources;

use App\Isap\Actions\Action;
use App\Isap\Actions\ActionType;
use App\Isap\Forms\Components\FormSection;
use App\Isap\Forms\Components\MultiSelectInput;
use App\Isap\Forms\Components\TextInput;
use App\Isap\Forms\Form;

class DynamicResource extends BaseResource
{
    public static function form(ActionType $action_type) {}
    public static function table() {}
    public static function createForm(array $components, ActionType $action_type, $form_title, $route)
    {
        $form_component = [];
        $form = new Form($form_title);
        foreach ($components as $component) {
            $form_component[] = static::createComponent($component);
        }
        return $form->components($form_component)->action(static::getAction($action_type)?->setRoute($route));
    }

    private static function createComponent($component)
    {
        $input_component = null;
        switch ($component['input_type']) {
            case 'text':
                $input_component = TextInput::make($component['name'], $component['title']);
                break;
            case 'number':
                $input_component = TextInput::make($component['name'], $component['title'])->isNumber();
                break;
            case 'select':
                $input_component = MultiSelectInput::make($component['name'], $component['title'])->setIsNotMulti()->setSource($component['src'] ?? []);
                break;
        }
        return FormSection::make('', '')->children([$input_component]);
    }
}
