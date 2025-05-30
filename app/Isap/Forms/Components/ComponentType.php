<?php

namespace App\Isap\Forms\Components;

enum ComponentType: string
{
    case TEXT = 'TextInput';
    case RICHTEXT = 'RichText';
    case FILE = 'File';
    case IMAGE = 'Image';
    case GALLERY = 'Gallery';
    case DATE = 'Date';
    case DATETIME = 'DateTime';
    case SELECT = 'Select';
    case MULTISELECT = 'MultipleSelect';
    case TOGGLE = 'Toggle';
    case ICON = 'IconInput';
    case SECTION = 'FormSection';
}
