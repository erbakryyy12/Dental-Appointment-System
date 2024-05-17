<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import the User model

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'userName' => 'required|string|max:255',
            'userIC' => 'required|string|max:255|unique:users',
            'userEmail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'userPhone' => 'required|string|max:255',
            'userGender' => 'required|string|in:Male,Female',
            'userRole' => 'required|string|in:User,Dentist',
        ]);

        // Create a new user instance
        $user = new User([
            'userName' => $request->input('userName'),
            'userIC' => $request->input('userIC'),
            'userEmail' => $request->input('userEmail'),
            'password' => bcrypt($request->input('password')),
            'userPhone' => $request->input('userPhone'),
            'userGender' => $request->input('userGender'),
            'userRole' => $request->input('userRole'),
        ]);

        // Save the user to the database
        $user->save();

        // Redirect the user after registration
        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }
}
