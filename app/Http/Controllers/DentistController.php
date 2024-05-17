<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dentist;
use App\Models\Appointment;
use Carbon\Carbon;

class DentistController extends Controller
{
    // Display dashboard for the dentist
    public function index(Request $request)
    {
        // Retrieve the authenticated user
        $dentist = Auth::user();

        // Check the user is authenticated and is a dentist
        if ($dentist && $dentist->userRole === 'Dentist') {
            // Retrieve appointments associated with the dentist
            $appointments = $dentist->appointments()
                ->where('appointmentDate', '>=', now()->startOfWeek())
                ->where('appointmentDate', '<=', now()->endOfWeek())
                ->get();

            // Return the view with the data
            return view('dentist.index', [
                'appointments' => $appointments,
            ]);
        } else {
            // User is not authenticated as a dentist, redirect to login page or handle accordingly
            return redirect()->route('login')->with('error', 'Please log in as a dentist to view your dashboard.');
        }
    }

    public function dentistApp()
    {

    }

    public function record()
    {

    }

    // Show user profile
    public function showProfile()
    {
        // Check if the user is authenticated
        if(auth()->check()) {
            // Retrieve the authenticated user
            $user = auth()->user(); 
            return view('dentist.dentistProfile', compact('user')); // Pass the user data to the view
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
        
    


    

