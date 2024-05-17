<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Profile dentist
-->

@extends('layouts.baseDentist')
@section('content')

<style>
    .header-title {
        color: black; /* Set the color of the header title to black */
    }
</style> 

<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Profile
        </h1>
    </div>
    <div class="card-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-0">Dentist Profile</h3>
                </div>
                <div class="card-body">
                     <!-- Profile Edit Form -->
                     <form method="POST" action="{{ route('dentist.profile.update') }}" >
                        @csrf

                        <div class="mb-3">
                            <label for="userName" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" id="userName" name="userName" value="{{ $user->userName }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="userIC" class="form-label">Identification Number:</label>
                            <input type="text" class="form-control" id="userIC" name="userIC" value="{{ $user->userIC }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="userEmail" name="userEmail" value="{{ $user->userEmail }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="userPhone" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control" id="userPhone" name="userPhone" value="{{ $user->userPhone }}" required>
                        </div>


                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection