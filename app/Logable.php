<?php

namespace App;

use Spatie\Activitylog\Facades\CauserResolver;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait Logable
{
    //
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $user = auth('admin')->check() ? auth('admin')->user() : (auth('customer')->user() ?? null);
        CauserResolver::setCauser($user);

        return LogOptions::defaults()->logAll();
    }
}
