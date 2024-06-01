<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dentist;
use App\Models\User;
use App\Models\Appointment;

use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        // Retrieve data from appointment table
        $appointments = Appointment::all();
        
        // Return view with appointment data
        return view('User.myAppointment', ['appointments' => $appointments]);
    }

    // Controller method to make appointment
    public function makeAppointment($dentistId)
    {
        // Retrieve the selected dentist from the database along with their associated user
     $selectedDentist = Dentist::with('user')->findOrFail($dentistId);
     
        // Retrieve existing appointment times for the selected dentist
        $existingAppointments = Appointment::where('dentistID', $dentistId)->pluck('appointmentTime')->toArray();

        // Generate an array of all time slots for the day (assuming appointments start at 9:00 AM and end at 5:00 PM with 30-minute intervals)
        $allTimeSlots = [];
        $startTime = Carbon::parse('09:00');
        $endTime = Carbon::parse('17:00'); // Adjusted end time to 5:00 PM
        while ($startTime < $endTime) {
            $allTimeSlots[] = $startTime->format('H:i');
            $startTime->addMinutes(60); // Assuming 60-minute intervals
        }

        // Remove existing appointment times from the list of available time slots
        $availableTimeSlots = array_diff($allTimeSlots, $existingAppointments);

        // Pass the selected dentist and available time slots to the view
        return view('User.appointment', [
            'selectedDentist' => $selectedDentist,
            'dentistID' => $dentistId, // Pass the dentistID to the view
            'availableTimeSlots' => $availableTimeSlots
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'userID' => 'required|exists:users,userID', 
            'dentistID' => 'required|exists:dentists,dentistID', 
            'selectedDate' => 'required|date',
            'selectedTime' => 'required|string', 
            'confirmAppointment' => 'required', 
        ]);

        // Create a new appointment record in the database
        $appointment = Appointment::create([
            'userID' => $request->userID,
            'dentistID' => $request->dentistID,
            'appointmentDate' => $request->selectedDate,
            'appointmentTime' => $request->selectedTime, 
            'medicalPrescription' => '', // Assuming medicalPrescription is optional
            'status' => 'Pending',
        ]);

        // Check if the appointment was successfully created
        if ($appointment) {
            return redirect()->route('user.myAppointment')->with('success', 'Appointment created successfully');
        } else {
            // Handle error if appointment creation fails
            return back()->withInput()->withErrors('Failed to create appointment.');
        }
    }

    public function myAppointment()
    {
        $upcomingAppointment = Appointment::where('appointmentDate', '>=', now()->format('d-m-Y'))
            ->where('userID', auth()->id())
            ->get();

        return view('user.myAppointment', [
            'upcomingAppointment' => $upcomingAppointment,
        ]);
    }
    

    // Route for rescheduling appointment
    public function reschedule($appointmentId)
    {
        $appointment = Appointment::with('dentist.user')->findOrFail($appointmentId);

        // Retrieve existing appointment times for the selected dentist
        $existingAppointments = Appointment::where('dentistID', $appointment->dentistID)
            ->where('appointmentID', '!=', $appointmentId) // Exclude current appointment
            ->whereDate('appointmentDate', '>=', now())
            ->pluck('appointmentTime')
            ->toArray();

        // Generate an array of all time slots for the day
        $allTimeSlots = [];
        $startTime = Carbon::parse('09:00');
        $endTime = Carbon::parse('17:00');
        while ($startTime < $endTime) {
            $allTimeSlots[] = $startTime->format('H:i');
            $startTime->addMinutes(60); // Assuming 60-minute intervals
        }

        // Remove existing appointment times from the list of available time slots
        $availableTimeSlots = array_diff($allTimeSlots, $existingAppointments);

        // Pass the appointment and available time slots to the view
        return view('User.reschedule', [
            'appointment' => $appointment,
            'availableTimeSlots' => $availableTimeSlots
        ]);
    }


    public function update(Request $request, $appointmentId)
    {
        // Validate the request
        $request->validate([
            'selectedDate' => 'required|date|after:today',
            'selectedTime' => 'required',
        ]);

        // Find the appointment
        $appointment = Appointment::findOrFail($appointmentId);

        // Update the appointment details
        $appointment->appointmentDate = Carbon::parse($request->input('selectedDate'));
        $appointment->appointmentTime = $request->input('selectedTime');

        // Save the updated appointment
        $appointment->save();

        // Redirect with a success message
        return redirect()->route('user.myAppointment')->with('success', 'Appointment rescheduled successfully.');
    }



}



