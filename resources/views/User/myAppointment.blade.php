<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    My Appointment
-->

@extends('layouts.baseUser')
@section('User.myAppointment')

<style>
    .header-title {
        color: black; /* Set the color of the header title to black */
    }

    /* Style for the appointment list */
    .appointment-list {
        border: 1px solid #ccc; /* Add a border around each appointment */
        padding: 20px; /* Add padding to create space between appointments */
        margin-bottom: 20px; /* Add margin at the bottom of each appointment */
    }

    .appointment-list img {
        float: left; /* Float the image to the left */
        margin-right: 20px; /* Add margin to the right of the image */
    }

    .appointment-details {
        overflow: hidden; /* Clear floats */
    }

    .appointment-details h5 {
        margin-top: 0; /* Remove margin from the top of the heading */
        margin-bottom: 10px; /* Add margin at the bottom of the heading */
    }

    .appointment-details p {
        margin: 0; /* Remove margin from paragraphs */
    }
    
</style>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="header">
                <h1 class="header-title">
                    My Appointment
                </h1>
            </div>
        </div>
    </div>

    <div class="card">
        <!-- Tabs for different categories -->
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="true">Upcoming</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cancelled-tab" data-bs-toggle="tab" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Upcoming Appointments -->
                    <div class="tab-pane fade show active" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                    
                        @foreach ($upcomingAppointment as $appointment)
                        <div class="appointment-list" data-appointment-id="{{ $appointment->id }}">
                            @if($appointment->dentist->dentistImage)
                                <img src="{{ Storage::url($appointment->dentist->dentistImage) }}" class="card-img-top img-fluid" alt="Dentist Image" style="width: 100px; height: 100px;">
                            @else
                                <img src="/path/to/default/image.jpg" class="card-img-top img-fluid" alt="Default Image"style="width: 100px; height: 100px;">
                            @endif
                                
                                <div class="appointment-details">
                                <span class="badge rounded-pill bg-primary status-badge">{{ $appointment->status }}</span> 
                                    <h5>Dentist: DR. {{ $appointment->dentist->user->userName }} </h5>
                                    <p>Date: {{ $appointment->appointmentDate }}</p>
                                    <p>Time: {{ $appointment->appointmentTime }}</p>
                                    <p>Patient: {{ $appointment->user->userName }}</p>
                                    <!-- Buttons for reschedule and cancel -->
                                    <div class="btn-group" role="group" aria-label="Reschedule and Cancel">
                                        <form action="{{ route('user.reschedule', ['appointmentId' => $appointment->appointmentID]) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" style="background-color: #B2EEF1;border-color: #B2EEF1;color: #000;">Reschedule</button>
                                        </form>
                                        <div style="margin-left: 10px;"></div>
                                        <form action="{{ route('appointment.cancel', ['appointmentId' => $appointment->appointmentID]) }}" method="POST" class="cancel-form">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-cancel" style="background-color: #FF5050;border-color: #FF5050;color: #000;">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Completed Appointments -->
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <!-- Display completed appointments here -->
                        @foreach ($completedAppointment as $appointment)
                        <div class="appointment-list" data-appointment-id="{{ $appointment->id }}">
                            <span class="badge rounded-pill bg-success status-badge">{{ $appointment->status }}</span>
                            @if($appointment->dentist->dentistImage)
                                <img src="{{ Storage::url($appointment->dentist->dentistImage) }}" class="card-img-top img-fluid" alt="Dentist Image" style="width: 100px; height: 100px;">
                            @else
                                <img src="/path/to/default/image.jpg" class="card-img-top img-fluid" alt="Default Image"style="width: 100px; height: 100px;">
                            @endif
                            <div class="appointment-details">
                                <h5>Dentist: DR. {{ $appointment->dentist->user->userName }}</h5>
                                <p>Date: {{ $appointment->appointmentDate }}</p>
                                <p>Time: {{ $appointment->appointmentTime }}</p>
                                <p>Patient: {{ $appointment->user->userName }}</p>
                                <p>Medical Prescription: {{ $appointment->medicalPrescription }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Cancelled Appointments -->
                    <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                        <!-- Display cancelled appointments here -->
                        @foreach ($cancelledAppointments as $appointment)
                        <div class="appointment-list" data-appointment-id="{{ $appointment->id }}">
                            <span class="badge rounded-pill bg-warning status-badge">{{ $appointment->status }}</span>
                            @if($appointment->dentist->dentistImage)
                                <img src="{{ Storage::url($appointment->dentist->dentistImage) }}" class="card-img-top img-fluid" alt="Dentist Image" style="width: 100px; height: 100px;">
                            @else
                                <img src="/path/to/default/image.jpg" class="card-img-top img-fluid" alt="Default Image"style="width: 100px; height: 100px;">
                            @endif
                            <div class="appointment-details">
                                <h5>Dentist: DR. {{ $appointment->dentist->user->userName }}</h5>
                                <p>Date: {{ $appointment->appointmentDate }}</p>
                                <p>Time: {{ $appointment->appointmentTime }}</p>
                                <p>Patient: {{ $appointment->user->userName }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>  

</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function() {
    
    // Cancel button click event listener
    $('.btn-cancel').click(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var $form = $(this).closest('.cancel-form'); // Get the closest form

        // Display the confirmation dialog
        if (confirm('Are you sure you want to cancel this appointment?')) {
            // Submit the form via AJAX
            $.ajax({
                url: $form.attr('action'),
                method: $form.attr('method'),
                data: $form.serialize(),
                success: function(response) {
                    // If the cancellation is successful, remove the appointment from the UI
                    $form.closest('.appointment-list').remove();
                    alert('Appointment cancelled successfully.');
                },
                error: function(xhr, status, error) {
                    // If there's an error, display an alert with the error message
                    alert('Error: ' + xhr.responseText);
                }
            });
        }
    });

});

</script>
@endsection