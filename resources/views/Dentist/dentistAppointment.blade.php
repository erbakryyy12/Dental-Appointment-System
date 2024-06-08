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
                <h3>Upcoming Appointments</h3>
            </div>
            
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                                <th>No.</th>
                                <th>Patient Name</th>
                                <th>Appointment Date</th>
                                <th>Time</th>
                                <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $index => $appointment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $appointment->user->userName }}</td>
                                <td>{{ $appointment->appointmentDate }}</td>
                                <td>{{ $appointment->appointmentTime }}</td>
                                <td class="table-action">
                                     <!-- View -->
                                     <a href="#" data-bs-toggle="modal" data-bs-target="#view-{{ $appointment->appointmentID }}">
                                        <i class="align-middle fas fa-fw fa-eye" title="View Appointment"></i> 
                                    </a>
                                    <!--Edit-->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#update-{{ $appointment->appointmentID }}">
                                        <i class="align-middle fas fa-fw fa-pen" title="Edit Appointment"></i>
                                    </a>    
                                    <!-- Mark Complete -->
                                    <a href="{{ route('dentist.appointment.complete', $appointment->appointmentID) }}" onclick="return confirm('Are you sure you want to mark this appointment as complete?')">
                                        <i class="align-middle fas fa-fw fa-check" title="Mark Appointment Complete"></i>
                                    </a>  
                                </td>
                            </tr>

                            <!-- Modal View-->
                            <div class="modal fade" id="view-{{ $appointment->appointmentID }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Appointment Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="userName">Name</label>
                                                        <p class="fw-bolder">{{ $appointment->user->userName }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userIC">IC</label>
                                                        <p class="fw-bolder">{{ $appointment->user->userIC }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userEmail">Email</label>
                                                        <p class="fw-bolder">{{ $appointment->user->userEmail }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userPhone">Phone</label>
                                                        <p class="fw-bolder">{{ $appointment->user->userPhone }}</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="appointmentDate">Appointment Date</label>
                                                        <p class="fw-bolder">{{ $appointment->appointmentDate }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="appointmentTime">Appointment Time</label>
                                                        <p class="fw-bolder">{{ $appointment->appointmentTime }}</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-primary justify-content-center" data-bs-dismiss="modal">Back</button>                                                                    
                                            </div>
                                        </div>
                                    </div>
                            </div>


                            <!-- Modal for update -->
                            <div class="modal fade" id="update-{{ $appointment->appointmentID }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Appointment</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body m-3">
                                            <!-- Display appointment details -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="userName">Name</label>
                                                    <p class="fw-bolder">{{ $appointment->user->userName }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="userIC">IC</label>
                                                    <p class="fw-bolder">{{ $appointment->user->userIC }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="userEmail">Email</label>
                                                    <p class="fw-bolder">{{ $appointment->user->userEmail }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="userPhone">Phone</label>
                                                    <p class="fw-bolder">{{ $appointment->user->userPhone }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="appointmentDate">Appointment Date</label>
                                                    <p class="fw-bolder">{{ $appointment->appointmentDate }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="appointmentTime">Appointment Time</label>
                                                    <p class="fw-bolder">{{ $appointment->appointmentTime }}</p>
                                                </div>
                                            </div>
                                            <!-- Form for editing medical prescription -->
                                            <form method="POST" action="{{ route('dentist.appointment.update', $appointment->appointmentID) }}">
                                                @csrf
                                                @method('PUT') 
                                                <div class="form-group">
                                                    <label for="medicalPrescription">Medical Prescription</label>
                                                    <input type="text" class="form-control" id="medicalPrescription" name="medicalPrescription" value="{{ $appointment->medicalPrescription }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #BBBBBB;border-color: #BBBBBB;color: #000;" >Close</button>
                                                    <button type="submit" class="btn btn-info" name="updateAppointment" style="background-color: #B2F1B8;border-color: #B2F1B8;color: #000;" >Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                     </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>

       document.addEventListener("DOMContentLoaded", function () {
        // Datatables basic
        $('#datatables-basic').DataTable({
            responsive: true
        });

        // Datatables with Buttons
        var datatablesButtons = $('#datatables-buttons').DataTable({
            lengthChange: !1,
            
            responsive: true
        });
        datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");

});


</script>
@endsection

