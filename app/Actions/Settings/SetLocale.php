<?php

namespace App\Actions\Settings;

use App\Actions\BaseAction;
use Illuminate\Support\Facades\Cookie;

class SetLocale extends BaseAction
{
    public function execute($data)
    {
        $locale = $data['locale'];
        // dd($locale);
        app()->setLocale($locale);
        Cookie::queue(Cookie::make('locale', $locale, 1440));

        return back(); //->withCookie(cookie('locale', $locale, 43200, null, null, true, false, false, 'None')->withDomain(''));
    }
}
