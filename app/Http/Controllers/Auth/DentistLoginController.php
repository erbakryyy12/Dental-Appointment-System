<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 

class DentistLoginController extends Controller
{
    use AuthenticatesUsers;

    public function login()
    {
        return view('auth.dentistLogin');
    }

    //dentist login
    public function loginPost(Request $request)
    {
        $credentials = [ 
            'userEmail' => $request->userEmail, 
            'password' => $request->password, 
        ];
    
        // Attempt authentication
        if (Auth::attempt($credentials)) {
            return redirect('/dentist/dashboard')->with('success', 'Successfully logged in.');
        }
    
        // Authentication failed, redirect back with error message
        return back()->with('error', 'Invalid email or password.');
        
    }
}