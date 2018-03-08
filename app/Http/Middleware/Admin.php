<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $user = $request->user();

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        if (request()->wantsJson()) {
          return response()->json(array(
              'error'   => 'invalid_access_token',
              'message' => "Vous n'avez pas les permissions"
          ), 401);
        } else {
          return redirect()->route('home');
        }
    }
}
