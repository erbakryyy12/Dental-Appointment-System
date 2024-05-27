<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Medical records
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
                    <h1>Medical Records</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>History</h3>
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
                                            <i class="align-middle fas fa-fw fa-eye"></i> 
                                        </a>
                                        <!-- Delete -->
                                        <a href="/medicalRecords/{{$appointment->appointmentID}}/delete" class="delete-link">
                                            <i class="align-middle fas fa-fw fa-trash"></i>
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
                                                    <br>
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="medicalPrescription">Medical Prescription</label>
                                                            <p class="fw-bolder">{{ $appointment->medicalPrescription }}</p>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary justify-content-center" data-bs-dismiss="modal" style="background-color: #B2F1B8;border-color: #B2F1B8;color: #000;" >Back</button>                                                                    
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

        var deleteLinks = document.querySelectorAll('.delete-link');

        deleteLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                var confirmation = confirm('Are you sure you want to delete the record?');

                if (!confirmation) {
                    event.preventDefault(); // Cancel the default behavior if not confirmed
                } else {
                    // If confirmed, proceed with the link action
                    window.location.href = link.getAttribute('href');

                }
            });
        });
});


</script>
@endsection