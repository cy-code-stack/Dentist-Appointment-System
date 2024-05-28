<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Staff\StaffController; 

//Admin
use App\Http\Controllers\Admin\AdminDashboardController; 
use App\Http\Controllers\Admin\Manage_Services\ManageServicesController; 
use App\Http\Controllers\Admin\Managing_Staff\ManageStaffController; 
//End of Admin

//Staff
use App\Http\Controllers\Staff\Managing_User\ManageUserController;
use App\Http\Controllers\Staff\Appointment\AppointmentController;
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
    
    Route::get('/user/signin', [Authentication::class, 'index'])->name('signin');
    Route::post('/user/auth', [Authentication::class, 'loginUsers'])->name('authenticate');
    Route::get('/user/signup', [Authentication::class, 'indexSignup'])->name('signup');
    Route::post('/storeData', [Authentication::class,'submitUser'])->name('storeData');
    Route::get('/user/forgot', [Authentication::class, 'indexForgot'])->name('forgot');
    Route::get('/user/logout', [Authentication::class, 'logout'])->name('logout');


// Routes for authenticated users
Route::middleware(['guest'])->group(function () {
    //Start of Patient Controller
    Route::get('/user/patient/booking', [PatientController::class, 'indexPatient'])->name('appointment');

        //Book Appointment Section
            Route::post('/user/patient/setAppoitment', [PatientController::class, 'storeAppointment']);
            Route::get('/user/patient/displayAppointment', [PatientController::class, 'diplayServices']);
        //End of Book Appointment Section
        
    //End of Patient Controller

    //Admin Users
    Route::get('/user/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin');

        //Manage User
            Route::get('/user/admin/manage/user', [ManageStaffController::class, 'showUser']);
            Route::post('/user/admin/user/add', [ManageStaffController::class,'storeUser']);
            Route::put('/user/admin/user/verify/{id}', [ManageStaffController::class,'verifyUser']);
            Route::put('/user/admin/user/update/{id}', [ManageStaffController::class,'updateUser']);
            Route::delete('/user/admin/user/delete/{id}' , [ManageStaffController::class,'destroy']);
        //End of Manage User Routes
    
        //Manage Services
            Route::post('/admin/services/add', [ManageServicesController::class, 'storeService']);
            Route::get('/admin/display/data', [ManageServicesController::class, 'showServices']);
            Route::delete('/admin/services/delete/{id}', [ManageServicesController::class, 'destroyServices']);
            Route::put('/admin/services/edit/{id}', [ManageServicesController::class, 'updateServices']);
        //End of Managing Services

    //End of Admin  Controller

    //Staff Users
    Route::get('/user/staff/dashboard', [StaffController::class, 'index'])->name('staff');

        //Manage User
            Route::get('/user/staff/manage/user', [ManageUserController::class, 'showUser']);
            Route::post('/user/staff/user/add', [ManageUserController::class,'storeUser']);
            Route::put('/user/staff/user/verify/{id}', [ManageUserController::class,'verifyUser']);
            Route::put('/user/staff/user/update/{id}', [ManageUserController::class,'updateUser']);
            Route::delete('/user/staff/user/delete/{id}' , [ManageUserController::class,'destroy']);
        //End of Manage User Routes

        //Start of Appointment Routes
            Route::get('/user/staff/appointment/display', [AppointmentController::class, 'showAppointment']);
            Route::delete('/user/staff/delete/appointment/{id}', [AppointmentController::class, 'destroyAppointment']);
        //End of Appointment Routes

    //End of Staff Controller
});




// Restricted Routes
    Route::get('/user/admin/{path}',[App\Http\Controllers\HomeController::class, 'adminIndex'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );
    Route::get('/user/staff/{path}',[App\Http\Controllers\HomeController::class, 'index'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );
    Route::get('/user/patient/{path}',[App\Http\Controllers\HomeController::class, 'indexuserPatient'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );