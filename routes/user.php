<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\AppointmentController;
 



Route::get('/',[UserController::class,'index']);

Route::get('/contact',[ContactController::class,'index']);

Route::post('/createAppointment',[AppointmentController::class,'createAppointment']);

Route::get('/user_show_myappointment',[AppointmentController::class,'user_show_myappointment']); // Show user side Appointment


Route::get('/delete_appoint/{id}',[AppointmentController::class,'delete_appoint']); // Delete a Appointment


?>