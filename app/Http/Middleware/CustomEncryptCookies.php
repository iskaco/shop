<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomEncryptCookies extends EncryptCookies
{
    protected $except = [
        'locale'
    ];
}
