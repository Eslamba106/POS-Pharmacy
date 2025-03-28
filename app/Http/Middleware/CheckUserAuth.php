<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $guards = ['web', 'admins' ];   
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if($guard == 'admins'){
                    $route = 'admin';
                }
                 
                if($guard == 'web'){
                    $route = 'manager';
                }

                view()->share('main_route', $route);
                break;
            }
        }
        return $next($request);
    }
}
