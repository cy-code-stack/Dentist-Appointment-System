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

Route::middleware(['guest'])->group(function () {
    Route::get('/user/signin', [Authentication::class, 'index'])->name('signin');
    Route::post('/user/auth', [Authentication::class, 'loginUsers'])->name('authenticate');
    Route::get('/user/signup', [Authentication::class, 'indexSignup'])->name('signup');
    Route::post('/storeData', [Authentication::class,'submitUser'])->name('storeData');
    Route::get('/user/forgot', [Authentication::class, 'indexForgot'])->name('forgot');
});
Route::get('/user/logout', [Authentication::class, 'logout'])->name('logout');


// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    //Patient Part
    Route::get('/user/patient/booking', [PatientController::class, 'indexPatient'])->name('appointment');

    //Admin Part
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin');
    });

    //Staff Part
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/user/staff/dashboard', [StaffController::class, 'index'])->name('staff');
    });
});
    
// Restricted Routes
    Route::get('/admin/{path}',[App\Http\Controllers\HomeController::class, 'adminIndex'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );
    Route::get('/user/staff/{path}',[App\Http\Controllers\HomeController::class, 'index'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );
    Route::get('/user/patient/{path}',[App\Http\Controllers\HomeController::class, 'indexuserPatient'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );