<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BanDeleteMethod
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       // if ($request->ip() === '127.0.0.1') {
        if ($request->ip() === '127.0.0.') {
            return response('BANNED IP ADDRESS! ', 403);
        }
        $response = $next($request);
        $response->cookie('visited-our-site', true);
        return $response;
    }
}
