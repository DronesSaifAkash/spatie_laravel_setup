<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            $user = auth()->user();
            if($user->hasRole(['Super-Admin','admin'])){
                return $next($request);
            }
            abort(403, "User does not have correct Role.");
        }
        abort(401);
    }
}
