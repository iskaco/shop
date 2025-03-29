<?php

namespace App\Actions\Settings;

use App\Actions\BaseAction;

class SetLocale extends BaseAction
{
    public function execute($data)
    {
        $locale = $data['locale'];
        app()->setLocale($locale);
        return back()->withCookie(cookie()->forever('locale', $locale));
    }
}
