<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dentist;
use App\Models\User;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Display dashboard for the admin
    public function index()
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Get the start and end dates of the current week
        $startOfWeek = $currentDate->startOfWeek()->format('Y-m-d');
        $endOfWeek = $currentDate->endOfWeek()->format('Y-m-d');

        // Retrieve all appointments for the current week
        $appointments = Appointment::whereBetween('appointmentDate', [$startOfWeek, $endOfWeek])->get();

        // Retrieve number of dentist
        $numOfDentist = Dentist::count();

        // Retrieve number of patient
        $numOfPatient = User::where('userRole', 'user')->count();

        // Retrieve number of today's appointments
        $todayAppointments = Appointment::whereDate('appointmentDate', $currentDate->format('Y-m-d'))
                            ->count();

        // Retrieve number of all appointments
        $allAppointments = Appointment::count();

        // Pass the appointments to the view
        return view('admin.index', [
            'appointments' => $appointments,
            'numOfDentist' => $numOfDentist,
            'numOfPatient' => $numOfPatient,
            'todayAppointments' => $todayAppointments,
            'allAppointments' => $allAppointments,
        ]);
    }

    //dentist list
    public function dentistList(Request $request)
    {
        $dentists = Dentist::with('user')->get();

        return view('admin.doctor', [
            'dentists' => $dentists,
        ]);
    }

    //update dentist speciality
    public function update(Request $request, $id) 
    {
        // Validate the request data
        $request->validate([
            'dentistSpeciality' => 'required|string|max:255',
        ]);

        try 
        {
            // Find the dentist
            $dentist = Dentist::findOrFail($id);

            // Update the dentist speciality
            $dentist->dentistSpeciality = $request->input('dentistSpeciality');
            $dentist->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Dentist speciality updated successfully.');

        } 
        catch (\Exception $e) 
        {
            // Redirect back with error message if something goes wrong
            return redirect()->back()->with('error', 'Failed to update dentist speciality. Please try again.');
        }
    }

    

    //patient list
    public function patientList()
    {
        // Retrieve appointments with related user information
        $appointments = Appointment::with('user')->get();

        // Pass the data to the view
        return view('admin.patient', [
            'appointments' => $appointments,
        ]);
    }

    // Display report for the admin
    public function report()
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Retrieve number of dentist
        $numOfDentist = Dentist::count();

        // Retrieve number of patient
        $numOfPatient = User::where('userRole', 'user')->count();

        // Retrieve number of today's appointments
        $todayAppointments = Appointment::whereDate('appointmentDate', $currentDate->format('Y-m-d'))->count();

        // Retrieve number of all appointments
        $allAppointments = Appointment::count();

        // Retrieve number of this week's appointments
        $weeklyAppointments = Appointment::whereBetween('appointmentDate', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Retrieve number of this month's appointments
        $monthlyAppointments = Appointment::whereMonth('appointmentDate', now()->month)->count();

        // Pass the data to the view
        return view('admin.report', [
            'numOfDentist' => $numOfDentist,
            'numOfPatient' => $numOfPatient,
            'todayAppointments' => $todayAppointments,
            'allAppointments' => $allAppointments,
            'weeklyAppointments' => $weeklyAppointments,
            'monthlyAppointments' => $monthlyAppointments,
        ]);
    }

}
