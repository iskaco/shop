<?php

namespace App\Isap\Framework;

use Illuminate\Http\Request;

class HttpConstants
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public const METHODS = [
        Request::METHOD_GET,
        Request::METHOD_POST,
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE,
        Request::METHOD_OPTIONS,
        Request::METHOD_HEAD,
    ];
    
}
