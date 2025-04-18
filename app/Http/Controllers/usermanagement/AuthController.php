<?php

namespace App\Http\Controllers\usermanagement;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd($request->all());
        if (isset($request['email']) && auth()->attempt(['user_name' => $request['email'], 'password' => $request['password']])) {
            $user = User::where('user_name', $request['email'])->first();
            session()->put('user_logged_in', true);
        } elseif (isset($request['email']) && auth()->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = User::where('email', $request['email'])->first();
            session()->put('user_logged_in', true);
        }
        
         

        if (auth()->check()) {
           
            return redirect()->route('dashboard');
        } else { 
            return redirect()->back()->with('error', __('login.user_not_found'));
        }
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return to_route('login-page');
    }
}
