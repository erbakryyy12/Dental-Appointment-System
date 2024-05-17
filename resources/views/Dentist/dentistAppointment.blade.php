<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Dentist Appointment
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
                    <h1>Appointment</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Your Upcoming Appointments for This Week</h3>
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

