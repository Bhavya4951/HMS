<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


require __DIR__.'/user.php';

require __DIR__.'/admin.php';


Route::get('/welcome', function () {
    return abort('404');
});

Route::get('/home',[HomeController::class,'redirect'])->middleware('auth','verified');

Route::get('auth/google', [HomeController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [HomeController::class, 'handleGoogleCallback']);
