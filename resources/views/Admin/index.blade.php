<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Dashboard Admin
-->
@extends('layouts.baseAdmin')
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
        <div class="col-md-3">
            <div class="card text-bg-light mb-3" style="max-width: 12rem;">
                <!-- Dentist -->
                <div class="card-header">Dentists</div>
                <div class="card-body">
                    <h2><b>{{ $numOfDentist }}</b></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-light mb-3" style="max-width: 12rem;">
                <!-- Patients -->
                <div class="card-header">Patients</div>
                <div class="card-body">
                    <h2><b>{{ $numOfPatient }}</b></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-light mb-3" style="max-width: 12rem;">
                <!-- Today appointments  -->
                <div class="card-header">Today appointments</div>
                <div class="card-body">
                    <h2><b>{{ $todayAppointments }}</b></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-light mb-3" style="max-width: 12rem;">
                <!-- Total appointments  -->
                <div class="card-header">All appointments</div>
                <div class="card-body">
                    <h2><b>{{ $allAppointments }}</b></h2>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Appointments for This Week</h3>
            </div>
            
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                                <th>No.</th>
                                <th>Patient Name</th>
                                <th>Schedule Date</th>
                                <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $index => $appointment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $appointment->user->userName }}</td>
                                <td>{{ $appointment->appointmentDate }}</td>
                                <td>{{ $appointment->appointmentTime }}</td>
                            </tr>
                        @endforeach
                     </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection