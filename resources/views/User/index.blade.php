<!--
    ERNIE MASTURA BINTI BAKRI (CB21161)
    DENTAL APPOINTMENT SYSTEM
    Dashboard User
-->

@extends('layouts.baseUser')
@section('User.index')

<style>
    .header-title {
        color: black; /* Set the color of the header title to black */
    }

    .card {
        margin-bottom: 20px; /* Add some margin at the bottom of each card */
        height: 100%;
    }

    .card-img-top {
        height: 200px; /* Set a fixed height for the card image */
        object-fit: cover; /* Ensure the image covers the entire space */
    }

    .card-body {
        height: 200px; /* Set a fixed height for the card body */
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="header">
                <h1 class="header-title">
                    Dashboard
                </h1>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card ">
            <div class="card-body h-100">
                <div class="row">
                    @foreach($dentists as $dentist)
                    <div class="col-md-4 mb-4">
                        <div class="card "> 
                            <img src="/img/dentist female.jpeg" class="card-img-top" alt="Dentist Image">
                            <div class="card-body">
                                <h5 class="card-title">DR.{{ optional($dentist->user)->userName }}</h5>
                                <p class="card-text">{{ $dentist->dentistSpeciality }}</p>
                                <form action="{{ route('user.appointment', ['dentistId' => $dentist->dentistID]) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="background-color: #B2EEF1;border-color: #B2EEF1;color: #000;">Make Appointment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
