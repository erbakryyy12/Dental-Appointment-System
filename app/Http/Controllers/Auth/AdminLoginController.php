<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin; 

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function login()
    {
        return view('auth.adminLogin');
    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'adminEmail' => $request->adminEmail,
            'password' => $request->password,
        ];
    
        // Attempt authentication using the 'admin' guard
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/admin/dashboard')->with('success', 'Successfully logged in.');
        }
    
        // Authentication failed, redirect back with error message
        return back()->with('error', 'Invalid email or password.');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
