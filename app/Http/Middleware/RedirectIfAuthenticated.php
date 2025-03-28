<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        
        $guards =  ['web', 'admins' ] ;
        // $guards = empty($guards) ? ['web', 'admins' ] : $guards;
         
        $url = url()->previous();
        $url_array = explode('/' , $url);
        if(in_array('admin' , $url_array)){
           $route = 'admin';
        }
         
        else{
           $route = 'web';
        } 
        // dd($guards);
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($route == 'admin') {
                    return redirect(RouteServiceProvider::ADMIN);
                }
              
                return redirect(RouteServiceProvider::HOME); 
            }
        }
    
        return $next($request);
    }
    
}
