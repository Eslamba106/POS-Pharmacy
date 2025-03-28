<?php

namespace App\Http\Controllers\usermanagement;

use App\Models\Admin; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function login(Request $request)
    {  
         if(isset($request['email']) && Auth::guard('admins')->attempt(['user_name' => $request->input('email'), 'password' => $request->input('password')])){
            $user = Admin::where('user_name', $request['email'])->first();
            session()->put('user_logged_in', true);
        }elseif (isset($request['email']) && Auth::guard('admins')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $user = Admin::where('email', $request->input('email'))->first();
            session()->put('user_logged_in', true);
        }

        if (auth()->guard('admins')->check()) {
             
            return redirect()->route('admin.dashboard');
        } else { 
            return redirect()->back()->with('error', __('login.user_not_found'));
        }
    }


    public function logout()
    { 
        Auth::guard('admins')->logout();
        session()->invalidate();
        session()->regenerateToken(); 
        return to_route('admin.login-page');
    }
}
