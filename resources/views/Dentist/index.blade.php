<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Dashboard Dentist
-->
@extends('layouts.baseDentist')
@section('content')

<style>
    .header-title {
        color: black; /* Set the color of the header title to black */
    }

    .card {
        margin-bottom: 20px; /* Add some margin at the bottom of each card */
        height: 100%;
    }
</style>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="header">
                <div class="header-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-light mb-3" style="max-width: 15rem;">
                <!-- My Patients -->
                <div class="card-header">My Patients</div>
                <div class="card-body">
                    <h2><b>{{ $uniquePatients }}</b></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-light mb-3" style="max-width: 15rem;">
                <!-- My Appointments -->
                <div class="card-header">My Appointments</div>
                <div class="card-body">
                    <h2><b>{{ $myAppointments }}</b></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-light mb-3" style="max-width: 15rem;">
                <!-- Today appointments  -->
                <div class="card-header">Today appointments</div>
                <div class="card-body">
                    <h2><b>{{ $todayAppointments }}</b></h2>
                </div>
            </div>
        </div>
    </div>


    <br>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Your Appointments for This Week</h3>
            </div>
            
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                                <th>No.</th>
                                <th>Patient Name</th>
                                <th>Schedule Date</th>
                                <th>Time</th>
                                <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $index => $appointment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $appointment->user->userName }}</td>
                                <td>{{ $appointment->appointmentDate }}</td>
                                <td>{{ $appointment->appointmentTime }}</td>
                                <td><span class="badge rounded-pill bg-primary status-badge">{{ $appointment->status }}</td>
                            </tr>
                        @endforeach
                     </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>

@endsection
