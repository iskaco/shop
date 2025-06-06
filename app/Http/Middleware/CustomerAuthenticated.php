<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('customer')->user()) {
            return $next($request);
        }
        if (! $request->inertia() && ($request->ajax() || $request->wantsJson())) {
            return response('Unauthorized.', 401);
        } else {
            return redirect()->route('shop.signin');
        }
    }
}
