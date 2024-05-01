<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Patient\PatientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing_page');
});

// Authentication Part
    Route::get('/staff/signin', [Authentication::class, 'index'])->name('signin');
    Route::get('/staff/forgot', [Authentication::class, 'indexForgot'])->name('forgot');

//Patient Part
    Route::get('/appointment/booking', [PatientController::class, 'indexPatient'])->name('appointment');