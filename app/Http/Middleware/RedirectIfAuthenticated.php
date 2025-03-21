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
        // استخدم الحراس الممررين أو ضع الافتراضيين
        $guards = empty($guards) ? ['web', 'admins', 'staffs'] : $guards;
         
        $url = url()->previous();
        $url_array = explode('/' , $url);
        if(in_array('admin' , $url_array)){
           $route = 'admin';
        }
        else if(in_array('staff' , $url_array)){
           $route = 'staff';
        }
        else{
           $route = 'web';
        } 
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($route == 'admin') {
                    return redirect(RouteServiceProvider::ADMIN);
                }
                if ($route == 'staff') {
                    return redirect(RouteServiceProvider::STAFF);
                }
                return redirect(RouteServiceProvider::HOME); 
            }
        }
    
        return $next($request);
    }
    
}
