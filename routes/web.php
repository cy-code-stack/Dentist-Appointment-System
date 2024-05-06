<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Staff\StaffController; 
use App\Http\Controllers\Admin\AdminDashboardController; 
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
    Route::get('/user/signin', [Authentication::class, 'index'])->name('signin');
    Route::get('/user/signup', [Authentication::class, 'indexSignup'])->name('signup');
    Route::get('/user/forgot', [Authentication::class, 'indexForgot'])->name('forgot');

//Patient Part
    Route::get('/user/appointment/booking', [PatientController::class, 'indexPatient'])->name('appointment');
    
    
//Admin Part
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin');
    
    //Staff Part
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff');
    
    
    Route::get('/admin/{path}',[App\Http\Controllers\HomeController::class, 'adminIndex'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );
    Route::get('/{path}',[App\Http\Controllers\HomeController::class, 'index'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );