<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    { 
        if (! $request->expectsJson()) {
            // return route('login');
            if($request->is('admin') || $request->is('admin/*')){
                // in case backend
                return route('admin.login-page');
            }else if($request->is('staff') || $request->is('staff/*')){
                // in case front end
                return route('staff.login-page');

            }else{
                return route('login-page');
            }
        }
        return route('login-page');
 
    }
}
