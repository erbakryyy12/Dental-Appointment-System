<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    admin: report page
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
                    <h1>Report</h1>
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

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Appointments Overview</div>
                    <div class="card-body">
                        <canvas id="appointmentsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Patients and Dentists</div>
                    <div class="card-body">
                        <canvas id="patientsDentistsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Data for the appointments chart
        var appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
        var appointmentsChart = new Chart(appointmentsCtx, {
            type: 'bar',
            data: {
                labels: ['Today', 'This Week', 'This Month'],
                datasets: [{
                    label: 'Appointments',
                    data: [{{ $todayAppointments }}, {{ $weeklyAppointments }}, {{ $monthlyAppointments }}],
                    backgroundColor: ['#FFF171', '#36A2EB', '#FFF171'],
                    borderColor: ['#FFF171', '#36A2EB', '#FFF171'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Data for the patients and dentists chart
        var patientsDentistsCtx = document.getElementById('patientsDentistsChart').getContext('2d');
        var patientsDentistsChart = new Chart(patientsDentistsCtx, {
            type: 'pie',
            data: {
                labels: ['Dentists', 'Patients'],
                datasets: [{
                    label: 'Users',
                    data: [{{ $numOfDentist }}, {{ $numOfPatient }}],
                    backgroundColor: ['#BBBBBB', '#FFF171'],
                    borderColor: ['#BBBBBB', '#FFF171'],
                    borderWidth: 1
                }]
            }
        });
    });
</script>

@endsection
