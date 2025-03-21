<?php

namespace App\Http\Controllers\usermanagement;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class AuthStaffController extends Controller
{
    public function login(Request $request)
    { 
        
         if(isset($request['email']) && Auth::guard('staffs')->attempt(['user_name' => $request->input('email'), 'password' => $request->input('password')])){
            $user = Staff::where('user_name', $request['email'])->first();
            session()->put('user_logged_in', true);
        }elseif (isset($request['email']) && Auth::guard('staffs')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            $user = Staff::where('email', $request->input('email'))->first();
            session()->put('user_logged_in', true);
        }

        if (auth()->guard('staffs')->check()) {
           
            return redirect()->route('dashboard');
        } else { 
            return redirect()->back()->with('error', __('login.user_not_found'));
        }
    }


    public function logout()
    {
        Auth::guard('staffs')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return to_route('login-page');
    }
}
