<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use App\Models\User; 


class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login()
    {
        return view('auth.login');
    }

    //user login
public function loginPost(Request $request)
{

    
    $credentials = [ 
        'userEmail' => $request->userEmail, 
        'password' => $request->password, 
    ];

    // Attempt authentication
    if (Auth::attempt($credentials)) {
        return redirect('/user/dashboard')->with('success', 'Successfully logged in.');
    }

    // Authentication failed, redirect back with error message
    return back()->with('error', 'Invalid email or password.');
}




    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('welcome');
    }
    
}
