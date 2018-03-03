<?php

namespace App\Http\Middleware;

// use Illuminate\Http\JsonResponse;
use Closure;

class AccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken() && $request->bearerToken() === config('app.access_token')) {
            return $next($request);
        }

        return response()->json(array(
            'error'      =>  'invalid_access_token',
            'message'   =>  "Access Token incorrect."
        ), 401);

    }
}
