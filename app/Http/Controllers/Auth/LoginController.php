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

    $request->validate([
        'userEmail' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('userEmail', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->userRole == 'User') {
            return redirect()->route('user.dashboard');
        } elseif ($user->userRole == 'Dentist') {
            return redirect()->route('dentist.index');
        } else {
            Auth::logout();
            return redirect()->route('login')->withErrors(['userRole' => 'Unauthorized user.']);
        }
    }

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
