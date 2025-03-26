<?php

namespace App\Isap\Framework;

use App\Models\User;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function check(int $userId, string|null $activityName = ''): bool
    {
        return User::find($userId)?->can($activityName) ?? false;
    }

    public function checkByRequest(Request $request): bool
    {
        return $this->check($request?->user()?->id ?? -1, $request->route()?->getName());
    }
}
