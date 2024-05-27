<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\DentistLoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Auth;


//WELCOME
Route::get('welcome', function () {return view('welcome');})->name('welcome');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//LOGIN - USER
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginPost'])->name('login');

//LOGIN - DENTIST
Route::get('/dentistLogin', [DentistLoginController::class, 'login'])->name('dentistLogin');
Route::post('/dentistLogin', [DentistLoginController::class, 'loginPost'])->name('dentistLogin');

//LOGIN - ADMIN
Route::get('/adminLogin', [AdminLoginController::class, 'login'])->name('adminLogin');
Route::post('/adminLogin', [AdminLoginController::class, 'loginPost'])->name('adminLogin');

//REGISTER
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

//USER DASHBOARD
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');


//APPOINTMENT 
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

// USER PROFILE 
Route::get('/userProfile', [UserController::class, 'showProfile'])->middleware('auth')->name('user.userProfile');
Route::post('/user/userProfile/update', [UserController::class, 'updateProfile'])->middleware('auth')->name('user.profile.update');

//DENTIST DASHBOARD
Route::get('/dentist/index', [DentistController::class, 'index'])->name('dentist.index');

//DENTIST APPOINTMENT
Route::get('/dentist/dentistAppointment', [DentistController::class, 'dentistAppointment'])->name('dentist.dentistAppointment');
Route::get('/dentist/appointment/complete/{id}', [DentistController::class, 'markComplete'])->name('dentist.appointment.complete');
Route::put('/dentist/appointment/update/{id}', [DentistController::class, 'update'])->name('dentist.appointment.update');

//MEDICAL RECORDS
Route::get('/dentist/medicalRecords', [DentistController::class, 'record'])->name('dentist.medicalRecords');

// DENTIST PROFILE 
Route::get('/profile', [DentistController::class, 'showProfile'])->middleware('auth')->name('dentist.dentistProfile');
Route::post('/dentist/profile/update', [DentistController::class, 'updateProfile'])->middleware('auth')->name('dentist.profile.update');


//ADMIN DASHBOARD
Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');

//ADMIN: DOCTOR
Route::get('/admin/doctor', [AdminController::class, 'dentistList'])->name('admin.doctor');
Route::put('/admin/doctor/update/{id}', [AdminController::class, 'update'])->name('admin.doctor.update');

//ADMIN: PATIENT
Route::get('/admin/patient', [AdminController::class, 'patientList'])->name('admin.patient');

//ADMIN: REPORT
Route::get('/admin/report', [AdminController::class, 'report'])->name('admin.report');