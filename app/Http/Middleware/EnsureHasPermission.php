<?php

namespace App\Http\Middleware;

use App\Isap\Framework\CheckPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!app(CheckPermission::class)->checkByRequest($request))
        {
            return redirect('/');
        }
        
        return $next($request);
    }
}
