<?php

namespace App\Isap\Tables\Columns;

enum ColumnType: string
{
    case TEXT  = 'Text';
    case IMAGE = 'Image';
    case TOGGLE = 'Toggle';
    case BADGE = 'Badge';
}
