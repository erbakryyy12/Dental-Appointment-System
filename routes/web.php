<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DentistLoginController;
use Illuminate\Support\Facades\Auth;



Route::get('welcome', function () {
    return view('welcome');
})->name('welcome');


Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//LOGIN - USER
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login');

//LOGIN - DENTIST
Route::get('/dentistLogin', [DentistLoginController::class, 'login'])->name('dentistLogin');
Route::post('/dentistLogin', [DentistLoginController::class, 'loginPost'])->name('dentistLogin');

//REGISTER
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

//DASHBOARD
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');


//APPOINTMENT - User
Route::get('/user/appointment/{dentistId}', [AppointmentController::class, 'makeAppointment'])->name('user.appointment');
Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');


//MY APPOINTMENT
Route::get('/user/myAppointment', [AppointmentController::class, 'index'])->name('user.myAppointment');
Route::get('/user/myAppointment', [AppointmentController::class, 'myAppointment'])->name('user.myAppointment');


//RESCHEDULE
Route::get('/user/reschedule/{appointmentId}', [AppointmentController::class, 'reschedule'])->name('user.reschedule');
Route::middleware(['auth'])->group(function () {
    Route::put('/appointments/{appointmentId}', [AppointmentController::class, 'update'])->name('appointment.update');
});

// PROFILE - User
Route::get('/userProfile', [UserController::class, 'showProfile'])->middleware('auth')->name('user.userProfile');
Route::post('/user/userProfile/update', [UserController::class, 'updateProfile'])->middleware('auth')->name('user.profile.update');

//DENTIST DASHBOARD
Route::get('/dentist/dashboard', [DentistController::class, 'index'])->name('dentist.dashboard');

//DENTIST APPOINTMENT
Route::get('/dentist/dentistAppointment', [DentistController::class, 'dentistApp'])->name('dentist.dentistAppointment');

//MEDICAL RECORDS
Route::get('/dentist/medicalRecords', [DentistController::class, 'record'])->name('dentist.medicalRecords');


// PROFILE - Dentist
Route::get('/profile', [DentistController::class, 'showProfile'])->middleware('auth')->name('dentist.dentistProfile');
Route::post('/dentist/profile/update', [DentistController::class, 'updateProfile'])->middleware('auth')->name('dentist.profile.update');