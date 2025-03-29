<?php

namespace App\Http\Controllers\Web;

use App\Actions\Settings\SetLocale;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Settings\SetLocaleRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function setLocale(SetLocaleRequest $request, SetLocale $action)
    {
        $action->execute($request->validated());
    }
}
