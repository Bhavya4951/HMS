<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AddPersonController;
use App\Http\Controllers\User\AppointmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
// Route::get('/admin', function () {
//     return "hello user";
// });

Route::get('/add_person',[AddPersonController::class,'index'])->middleware(['auth:sanctum','user_side']);
Route::post('/create_person',[AddPersonController::class,'create'])->middleware(['auth:sanctum']);

Route::get('/show_patient',[AppointmentController::class,'getPatientData'])->middleware(['auth:sanctum','user_side']);

Route::get('/approved/{id}',[AppointmentController::class,'approved'])->middleware(['auth:sanctum','user_side']); // Approved Appointment
Route::get('/approved//{id}',[AppointmentController::class,'approved'])->middleware(['auth:sanctum','user_side']); // Approved Appointment

Route::match(['GET', 'POST'],'/select_appointment_data/{id}',[AppointmentController::class,'select_appointment_data'])->middleware(['auth:sanctum','user_side']); // Select Appointment Date

Route::get('/canceled/{id}',[AppointmentController::class,'canceled'])->middleware(['auth:sanctum','user_side']); // Canceled Appointment  
Route::get('/canceled//{id}',[AppointmentController::class,'canceled'])->middleware(['auth:sanctum','user_side']); // Canceled Appointment  

Route::get('/completed/{id}',[AppointmentController::class,'completed'])->middleware(['auth:sanctum','user_side']); // completed Appointment
Route::get('/completed//{id}',[AppointmentController::class,'completed'])->middleware(['auth:sanctum','user_side']); // completed Appointment   

Route::get('/sendmail/{id}',[AppointmentController::class,'sendmail'])->middleware(['auth:sanctum','user_side']);   // get Page of Mail to User for Appointment
//Route::get('/sendmail//{id}',[AppointmentController::class,'sendmail']);  // get Page of Mail to User for Appointment 

Route::post('/email_send/{id}',[AppointmentController::class,'email_send'])->middleware(['auth:sanctum','user_side']); // Send a Mail to User
Route::get('/email_send//{id}',[AppointmentController::class,'sendmail'])->middleware(['auth:sanctum','user_side']);  // get Page of Mail to User for Appointment 

//Route::get('/filter_data/{status_category}/{search}',[AppointmentController::class,'filter_data']); // Drop Down Filter

Route::get('/live_search',[AppointmentController::class,'live_search'])->name('live_search')->middleware(['auth:sanctum','user_side']);  // Search Filter

Route::get('/todayAppointment',[AppointmentController::class,'todayAppointment'])->middleware(['auth:sanctum','user_side'])->name('todayAppointment'); // ShowTodayAppontmentList


Route::get('/dashboards',[AppointmentController::class,'countAppointmenr'])->middleware(['auth:sanctum','user_side']); // ShowTodayAppontmentList
//Route::get('/home',[HomeController::class,'redirect'])->middleware('auth','verified');

Route::get('/notifaction',[AppointmentController::class,'notifaction'])->middleware(['auth:sanctum','user_side']);  // ShowTodayAppontmentList

Route::get('/cnlnotifaction//{id}',[AppointmentController::class,'cnlnotifaction'])->middleware(['auth:sanctum','user_side']);  // Change 0 To 1 notifaction

//Route::view('/fullcalendar','admin.fullcalendar');  // Change 0 To 1 notifaction

Route::get('/download',[AppointmentController::class,'download'])->middleware(['auth:sanctum','user_side']);  // DWNLOD


?>