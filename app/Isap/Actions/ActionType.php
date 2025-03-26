<?php

namespace App\Isap\Actions;

enum ActionType: string
{
    case EDIT =  'Edit';
    case DELETE = 'Delete';
    case SHOW = 'Show';
    case UPDATE = 'Update';
    case STORE = 'Store';
    case CREATE = 'Create';
}
