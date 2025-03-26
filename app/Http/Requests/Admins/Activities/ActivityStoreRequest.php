<?php

namespace App\Http\Requests\Admins\Activities;

use App\Actions\Activities\ActivityValidationRules;
use App\Http\Requests\Admins\AdminsAuthRequest;
use Illuminate\Validation\Rule;

class ActivityStoreRequest extends AdminsAuthRequest
{
    public function __construct()
    {
        $this->action = 'activities.store';
    }

    public function rules(): array
    {
        return ActivityValidationRules::storeRules();
    }
}
