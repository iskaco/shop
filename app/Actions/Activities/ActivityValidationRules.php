<?php

namespace App\Actions\Activities;

use App\Http\Requests\Admins\AdminsAuthRequest;
use App\Isap\Framework\HttpConstants;
use App\Isap\Framework\Rules\RouteActionRule;
use App\Isap\Framework\Rules\RouteUriRule;
use App\Models\Activity;
use App\Models\Permission;
use Illuminate\Validation\Rule;

class ActivityValidationRules
{
    public static function storeRules(): array
    {
        return [
            'uri' => ['required', 'string', 'min:1', 'max:255', new RouteUriRule],
            'method' => ['required', Rule::in(HttpConstants::METHODS)],
            'action' => ['required', new RouteActionRule],
            'middleware' => ['array', 'min:0'],
            'title' => ['string', 'required', 'min:3', 'max:200'],
            'description' => ['string', 'required', 'min:3', 'max:1000'],
            'permission_id' => ['integer', Rule::exists(Permission::class, 'id')],
            'is_active' => ['boolean'],
            'icon_name' => ['string', 'nullable'],
            'is_menu' => ['boolean'],
            'parent_id' => ['integer', 'min:0', Rule::in(array_merge(Activity::all()->pluck('id')->all(), [0]))]
        ];
    }
}
