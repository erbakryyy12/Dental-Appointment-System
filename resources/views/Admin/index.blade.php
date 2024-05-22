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

</div>
@endsection