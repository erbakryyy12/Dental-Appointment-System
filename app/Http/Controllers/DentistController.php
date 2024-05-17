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
    public function index()
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Get the start and end dates of the current week
        $startOfWeek = $currentDate->startOfWeek()->format('Y-m-d');
        $endOfWeek = $currentDate->endOfWeek()->format('Y-m-d');

        // Retrieve the authenticated dentist's ID
        $dentistID = Auth::user()->dentist->dentistID;

        // Retrieve appointments for the current week
        $appointments = Appointment::where('dentistID', $dentistID)
            ->whereBetween('appointmentDate', [$startOfWeek, $endOfWeek])
            ->orderBy('appointmentDate')
            ->orderBy('appointmentTime')
            ->get();

            // Retrieve unique patients count
        $uniquePatients = Appointment::where('dentistID', $dentistID)
        ->distinct('userID')
        ->count('userID');

        // Retrieve total appointments count
        $myAppointments = Appointment::where('dentistID', $dentistID)
            ->count();

        // Retrieve today's appointments count
        $todayAppointments = Appointment::where('dentistID', $dentistID)
            ->whereDate('appointmentDate', $currentDate->format('Y-m-d'))
            ->count();

        // Pass data to the view
        return view('dentist.index', [
            'appointments' => $appointments,
            'uniquePatients' => $uniquePatients,
            'myAppointments' => $myAppointments,
            'todayAppointments' => $todayAppointments,
        ]);
    }
    

    public function dentistAppointment()
    {
        
        return view('dentist.dentistAppointment');
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
        
    


    

