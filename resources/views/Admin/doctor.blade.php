<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    admin: doctor page
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
                    <h1>Doctor</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>List of Doctors</h3>
                
            </div>
            <div class="card-body">
                <table id="datatables-buttons" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Doctor Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dentists as $index => $dentist)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dentist->user->userName }}</td>
                                <td>{{ $dentist->user->userEmail }}</td>
                                <td>{{ $dentist->user->userPhone }}</td>
                                <td class="table-action">
                                    
                                    <!-- View -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#view-{{ $dentist->dentistID }}">
                                        <i class="align-middle fas fa-fw fa-eye"></i> 
                                    </a>
                                    <!--Edit-->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#update-{{ $dentist->dentistID }}">
                                        <i class="align-middle fas fa-fw fa-pen"></i>
                                    </a>  
                                    <!-- Delete -->
                                    <a href="/doctor/{{$dentist->dentistID}}/delete" class="delete-link">
                                        <i class="align-middle fas fa-fw fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal View-->
                            <div class="modal fade" id="view-{{ $dentist->dentistID }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Dentist Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="userName">Name</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userName }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userIC">IC Number</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userIC }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userEmail">Email</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userEmail }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userPhone">Phone</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userPhone }}</p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="dentistSpeciality">Speciality</label>
                                                        <p class="fw-bolder">{{ $dentist->dentistSpeciality }}</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-primary justify-content-center" data-bs-dismiss="modal" style="background-color: #FFF171; border-color: #FFF171; color: #000;">Back</button>                                                                    
                                            </div>
                                        </div>
                                    </div>
                            </div>


                            <!-- Modal for update -->
                            <div class="modal fade" id="update-{{ $dentist->dentistID }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Dentist</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body m-3">
                                            <!-- Display dentist details -->
                                            <div class="row">
                                                    <div class="form-group">
                                                        <label for="userName">Name</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userName }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userIC">IC Number</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userIC }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userEmail">Email</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userEmail }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="userPhone">Phone</label>
                                                        <p class="fw-bolder">{{ $dentist->user->userPhone }}</p>
                                                    </div>
                                            </div>
                                            <!-- Form for editing dentist speciality -->
                                            <form method="POST" action="{{ route('admin.doctor.update', $dentist->dentistID) }}">
                                                @csrf
                                                @method('PUT') 
                                                <div class="form-group">
                                                    <label for="dentistSpeciality">Speciality</label>
                                                    <input type="text" class="form-control" id="dentistSpeciality" name="dentistSpeciality" value="{{ $dentist->dentistSpeciality }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #DFDFDF; border-color: #DFDFDF; color: #000;">Close</button>
                                                    <button type="submit" class="btn btn-info" name="updateDentist" style="background-color: #FFF171; border-color: #FFF171; color: #000;">Save</button>
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

        var deleteLinks = document.querySelectorAll('.delete-link');

        deleteLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                var confirmation = confirm('Are you sure you want to delete this?');

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