<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Dentist;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        // Retrieve the list of dentists from the database
        $dentists = Dentist::all();

        //retrieve all users from the database
        $users = User::all();
        
        // Pass the $dentists variable to the view
        return view('user.index', ['dentists' => $dentists]);
        
    }

    // Show user profile
    public function showProfile()
    {
        // Check if the user is authenticated
        if(auth()->check()) {
            // Retrieve the authenticated user
            $user = auth()->user(); 
            return view('user.userProfile', compact('user')); // Pass the user data to the view
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page or display an error message
            return redirect()->route('login')->with('error', 'Please log in to view your profile.');
        }
    }

    public function updateProfile(Request $request)
    {
        // Check if the user is authenticated
        if(auth()->check()) {
            // Validate the request data
            $validatedData = $request->validate([
                'userName' => 'required|string|max:255',
                'userIC' => 'required|string|max:255',
                'userEmail' => 'required|email|max:255',
                'userPhone' => 'required|string|max:255',
            ]);

            // Retrieve the authenticated user
            $user = auth()->user();

            // Check if the user exists
            if ($user) {
                // Update user data with the new values from the form
                $user->userName = $validatedData['userName'];
                $user->userIC = $validatedData['userIC'];
                $user->userEmail = $validatedData['userEmail'];
                $user->userPhone = $validatedData['userPhone'];

                // Save the updated user data
                $user->save();

                return redirect()->back()->with('success', 'Profile updated successfully!');
            } else {
                // Handle the case where the user is not found
                return redirect()->back()->with('error', 'User not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            // Redirect the user to the login page or display an error message
            return redirect()->route('login')->with('error', 'Please log in to update your profile.');
        }
    }

}

