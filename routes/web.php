<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Staff\StaffController; 

//Admin
use App\Http\Controllers\Admin\AdminDashboardController; 
use App\Http\Controllers\Admin\Manage_Services\ManageServicesController; 
use App\Http\Controllers\Admin\Managing_Staff\ManageStaffController; 
use App\Http\Controllers\Admin\Refer\AdminReferPatientsController; 
use App\Http\Controllers\Admin\Archive\AdminArchiveController;
//End of Admin

//Staff
use App\Http\Controllers\Staff\Managing_User\ManageUserController;
use App\Http\Controllers\Staff\Appointment\AppointmentController;
use App\Http\Controllers\Staff\Archieve\ArchieveController;
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
    Route::get('/verify/otp', [Authentication::class, 'indexVerify'])->name('verify');
    Route::post('/verify/user/acc', [Authentication::class, 'otpVerify'])->name('acc-verify');
    Route::post('/storeData', [Authentication::class,'submitUser'])->name('storeData');
    Route::get('/user/forgot', [Authentication::class, 'indexForgot'])->name('forgot');
    Route::post('/user/forgot/acc', [Authentication::class, 'indexForgotAcc'])->name('user-forgot');
    Route::get('/user/logout', [Authentication::class, 'logout'])->name('logout');


// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
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
            // Route::delete('/user/admin/user/delete/{id}' , [ManageStaffController::class,'destroy']);
            Route::put('/user/admin/staff/archive/{id}', [ManageStaffController::class, 'archiveStaff']);
        //End of Manage User Routes
    
        //Manage Services
            Route::post('/admin/services/add', [ManageServicesController::class, 'storeService']);
            Route::get('/admin/display/data', [ManageServicesController::class, 'showServices']);
            // Route::delete('/admin/services/delete/{id}', [ManageServicesController::class, 'destroyServices']);
            Route::put('/admin/services/edit/{id}', [ManageServicesController::class, 'updateServices']);
            Route::put('/admin/services/archive/{id}', [ManageServicesController::class, 'archiveServices']);
        //End of Managing Services

        //Refer Patients
            Route::get('/admin/patients/refer', [AdminReferPatientsController::class, 'getVerifiedPatients']);
            Route::put('/admin/patient/archive/{id}', [AdminReferPatientsController::class, 'archiveReferPatients']);
        //End of Refer Patients

        //Archive Page Section
            Route::get('/admin/staff/archive/display', [AdminArchiveController::class, 'showStaffArchive']);
            Route::get('/admin/refer/archive', [AdminArchiveController::class, 'showReferArchive']);
            Route::get('/admin/services/archive', [AdminArchiveController::class, 'showServicesArchive']);
            Route::put('/admin/staff/restore/{id}', [AdminArchiveController::class, 'restoreArchiveStaff']);
            Route::put('/admin/services/restore/{id}', [AdminArchiveController::class, 'restoreArchiveServices']);
            Route::put('/admin/refer/restore/{id}', [AdminArchiveController::class, 'restoreArchiveRefer']);
        //End of Archive Page Section

    //End of Admin  Controller

    //Staff Users
    Route::get('/user/staff/dashboard', [StaffController::class, 'index'])->name('staff');

        //Manage User
            Route::get('/user/staff/manage/user', [ManageUserController::class, 'showUser']);
            Route::post('/user/staff/user/add', [ManageUserController::class,'storeUser']);
            Route::put('/user/staff/user/verify/{id}', [ManageUserController::class,'verifyUser']);
            Route::put('/user/staff/user/update/{id}', [ManageUserController::class,'updateUser']);
            Route::put('/user/staff/user/archieve/{id}' , [ManageUserController::class,'archieveUser']);
        //End of Manage User Routes

        //Start of Appointment Routes
            Route::get('/user/staff/appointment/display', [AppointmentController::class, 'showAppointment']);
            // Route::delete('/user/staff/delete/appointment/{id}', [AppointmentController::class, 'destroyAppointment']);
            Route::put('/user/staff/recomend/doctor/{id}', [AppointmentController::class, 'recoAppointment']);
            Route::put('/user/staff/appointment/abort/{id}', [AppointmentController::class, 'abortAppointment']);
        //End of Appointment Routes

        //Archieve Section
            Route::get('/user/staff/archieve/display', [ArchieveController::class, 'showArchieve']);
            Route::put('/user/staff/archieve/restore/{id}', [ArchieveController::class, 'updateArchieve']);
            Route::get('/user/staff/appointment/declined', [ArchieveController::class, 'showAppointmentDeclined']);
        //End of Archieve Section

    //End of Staff Controller
});




// Restricted Routes
    Route::get('/user/admin/{path}',[App\Http\Controllers\HomeController::class, 'adminIndex'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );
    Route::get('/user/staff/{path}',[App\Http\Controllers\HomeController::class, 'index'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );
    Route::get('/user/patient/{path}',[App\Http\Controllers\HomeController::class, 'indexuserPatient'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' );

    