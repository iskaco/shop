<?php

namespace App\Actions\Settings;

use App\Actions\BaseAction;

class SetLocale extends BaseAction
{
    public function execute($data)
    {
        $locale = $data['locale'];
        // dd($locale);
        app()->setLocale($locale);

        return back()->withCookie(cookie('locale', $locale, 43200, null, null, true, true, false, 'None')->withDomain(''));
    }
}
