<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
        $appointments = Appointment::whereBetween('appointment_date', [$startOfWeek, $endOfWeek])->get();

        // Pass the appointments to the view
        return view('admin.index', [
            'appointments' => $appointments
        ]);
    }

}
