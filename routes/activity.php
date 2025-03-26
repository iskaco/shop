<?php

use App\Http\Middleware\EnsureHasPermission;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureHasPermission::class)->group(function () {
    try {
        $activities = Activity::active()->get();
        foreach ($activities as $activity) {
            Route::match([$activity->method], $activity->uri, $activity->action)
                ->middleware(json_decode($activity->middleware, true))
                ->name($activity->name);
        }
    } catch (Exception $exp) {
    }
});
