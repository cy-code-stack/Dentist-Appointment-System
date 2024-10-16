<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Staff\StaffController; 

//Landing page
use App\Http\Controllers\LandingPageController;

//Patient
use App\Http\Controllers\Patient\CalendarEvt\CalendarEventControllerPatient;
use App\Http\Controllers\Patient\View_Appointment\ViewAppointmentController;
use App\Http\Controllers\Patient\Profile\PatientProfileController;

//Admin
use App\Http\Controllers\Admin\AdminDashboardController; 
use App\Http\Controllers\Admin\Manage_Services\ManageServicesController; 
use App\Http\Controllers\Admin\Managing_Staff\ManageStaffController; 
use App\Http\Controllers\Admin\Refer\AdminReferPatientsController; 
use App\Http\Controllers\Admin\Archive\AdminArchiveController;
use App\Http\Controllers\Admin\Calendar\AdminCalendarController;
use App\Http\Controllers\Admin\Profile\AdminProfileController;
use App\Http\Controllers\Admin\Refer\PatientInformationController;
use App\Http\Controllers\Admin\Refer\DiagnosticController;
//End of Admin

//Staff
use App\Http\Controllers\Staff\Managing_User\ManageUserController;
use App\Http\Controllers\Staff\Appointment\AppointmentController;
use App\Http\Controllers\Staff\Archieve\ArchieveController;
use App\Http\Controllers\Staff\Inquiry\InquiryController;
use App\Http\Controllers\Staff\CalendarEvent\CalendarEventController;
use App\Http\Controllers\Staff\Profile\AssistantProfileController;

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

Route::get('/', function () { return view('landing_page');});
    
    Route::post('/inquiries/store', [LandingPageController::class, 'makeInquiry'])->name('inquiries.store');
        
    Route::get('/user/signin', [Authentication::class, 'index'])->name('signin');
    Route::post('/user/auth', [Authentication::class, 'loginUsers'])->name('authenticate');

    Route::get('/user/signup', [Authentication::class, 'indexSignup'])->name('signup');
    Route::post('/storeData', [Authentication::class,'submitUser'])->name('storeData');

    Route::get('/verify/otp', [Authentication::class, 'indexVerify'])->name('verify');
    Route::post('/verify/user/acc', [Authentication::class, 'otpVerify'])->name('acc-verify');

    Route::get('/user/forgot', [Authentication::class, 'indexForgot'])->name('forgot');
    Route::post('/user/forgot/acc', [Authentication::class, 'indexForgotAcc'])->name('user-forgot');
    Route::get('/user/reset/index/{token}', [Authentication::class, 'resetPass'])->name('reset');
    Route::post('/user/change/pass', [Authentication::class, 'changePass'])->name('changePass');

    Route::get('/user/logout', [Authentication::class, 'logout'])->name('logout');


// Routes for authenticated users
Route::middleware(['preventBackHistory', 'auth'])->group(function () {

    Route::middleware(['patient'])->group(function(){
        //Start of Patient Routes
        
            Route::get('/user/patient/booking', [PatientController::class, 'indexPatient'])->name('appointment');
            //Book Appointment Section
                Route::post('/user/patient/setAppointment', [PatientController::class, 'storeAppointment']);
                Route::get('/user/patient/displayAppointment', [PatientController::class, 'diplayServices']);
            //End of Book Appointment Section

            //Start of Calendar Event Routes
                // Route::get('/user/patient/display/calendar', [CalendarEventControllerPatient::class, 'displayEvnt']);
                Route::get('/user/patient/display/appointment', [CalendarEventControllerPatient::class, 'displayAppointment']);
            //End of Calendar Event Routes

            //Start of View Appointment Routes
                Route::get('/user/patient/appointment/view', [ViewAppointmentController::class,'displayAppointmentDate']);
                Route::put('/user/patient/appointment/view/{id}', [ViewAppointmentController::class,'displayAppointmentInfo']);
            //End of View Appointment Routes

            //Start of Profile Page
                Route::get('/user/patient/profile/displayUser', [PatientProfileController::class,'displayInfo']);
                Route::post('/user/patient/profile/uploadImage', [PatientProfileController::class,'uploadImage']);
                Route::delete('/user/patient/profile/deleteUser', [PatientProfileController::class,'destroyPatientUser']);
                Route::delete('/user/patient/profile/deleteImage', [PatientProfileController::class,'removePatientImg']);
                Route::put('/user/patient/profile/updateProfile/{id}', [PatientProfileController::class,'updatePatientProfile']);
                Route::post('/user/patient/profile/change_pass', [PatientProfileController::class,'updatePatientPassword']);
            //End of Profile Page

        //End of Patient Routes
    });
    

    Route::middleware(['admin'])->group(function() {
        //Start of Admin Routes
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
                Route::get('/admin/patients/index/{id}', [PatientInformationController::class, 'index']);
                Route::get('/admin/patients/show/{id}', [PatientInformationController::class, 'show']);
                Route::put('/admin/patient/archive/{id}', [AdminReferPatientsController::class, 'archiveReferPatients']);
                Route::post('/admin/patients/information', [PatientInformationController::class, 'store']);
                Route::get('/admin/patients/diagnostic', [DiagnosticController::class, 'index']);
                Route::get('/admin/patients/child', [DiagnosticController::class, 'childIndex']);
                Route::post('/admin/patients/diagnostic/store', [DiagnosticController::class, 'store']);
                Route::post('/admin/patients/child/store', [DiagnosticController::class, 'storeChild']);
                Route::post('/admin/patients/payment/store', [AppointmentController::class, 'addPayment']);
            //End of Refer Patients

            //Callendar Event Page Section
                Route::get('/admin/calendar/display/events', [AdminCalendarController::class, 'displayEvent']);
                Route::get('/admin/calendar/display/appointments', [AdminCalendarController::class, 'displayAppointment']);
            //End of Callendar Event Page Section

            //Archive Page Section
                Route::get('/admin/staff/archive/display', [AdminArchiveController::class, 'showStaffArchive']);
                Route::get('/admin/refer/archive', [AdminArchiveController::class, 'showReferArchive']);
                Route::get('/admin/services/archive', [AdminArchiveController::class, 'showServicesArchive']);
                Route::put('/admin/staff/restore/{id}', [AdminArchiveController::class, 'restoreArchiveStaff']);
                Route::put('/admin/services/restore/{id}', [AdminArchiveController::class, 'restoreArchiveServices']);
                Route::put('/admin/refer/restore/{id}', [AdminArchiveController::class, 'restoreArchiveRefer']);
            //End of Archive Page Section

            //Profile Page Section
                Route::get('/admin/profile/user', [AdminProfileController::class,'getProfileInfo']);
                Route::put('/admin/profile/update/{id}', [AdminProfileController::class,'updateProfile']);
                Route::post('/admin/profile/upload', [AdminProfileController::class,'uploadAvatar']);
                Route::delete('/admin/profile/destroy', [AdminProfileController::class,'removeImg']);
                Route::post('/admin/profile/changePass', [AdminProfileController::class,'updatePassword']);
                Route::delete('/admin/profile/userDestroy', [AdminProfileController::class,'destroyUser']);
            //End Profile
        //End of Admin Routes
    });  
    
    Route::middleware(['assistant'])->group(function(){

        //Start of Staff Routes
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
                Route::put('/user/staff/appointment/resched/{id}', [AppointmentController::class,'reschedAppointment']);
            //End of Appointment Routes

            //Start of Calendar Event Routes
                Route::get('/user/staff/event/display', [CalendarEventController::class, 'index']);
                Route::post('/user/staff/event/store', [CalendarEventController::class, 'storeEvent']);
                Route::get('/user/staff/calendar/display/appointment', [CalendarEventController::class, 'displayAppointment']);
            //End of Calendar Event Routes

            //Start of Inquiry Section
                Route::get('/user/staff/inquiry/display', [InquiryController::class, 'displayInquiry']);
                Route::put('/user/staff/inquiry/send/{id}', [InquiryController::class, 'replyInquiry']);
                Route::put('/user/staff/inquiry/alreadyCatered/{id}', [InquiryController::class, 'alreadyCatered']);
            //End of Inquiry Section

            //Archieve Section
                Route::get('/user/staff/archieve/display', [ArchieveController::class, 'showArchieve']);
                Route::put('/user/staff/archieve/restore/{id}', [ArchieveController::class, 'updateArchieve']);
                Route::get('/user/staff/appointment/declined', [ArchieveController::class, 'showAppointmentDeclined']);
            //End of Archieve Section

            //Start of Profile Section
                Route::post('/user/assistant/profile/upload', [AssistantProfileController::class, 'uploadImage']);
                Route::get('/user/assistant/profile/display', [AssistantProfileController::class,'displayProfile']);
                Route::put('/user/staff/profile/update/{id}', [AssistantProfileController::class,'updateAssistantProfile']);
                Route::delete('/user/assistant/profile/removeAvatar', [AssistantProfileController::class,'removeAvatar']);
                Route::post('/user/assistant/profile/passChange', [AssistantProfileController::class,'changePassword']);
                Route::delete('/user/assistant/profile/destroy', [AssistantProfileController::class,'destroyUserCred']);
            //End of Profile Section

        //End of Staff Routes
    });
});




// Restricted Routes
    Route::get('/user/admin/{path}',[App\Http\Controllers\HomeController::class, 'adminIndex'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' )->middleware('page.role:Dentist');
    Route::get('/user/staff/{path}',[App\Http\Controllers\HomeController::class, 'index'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' )->middleware('page.role:Assistant');
    Route::get('/user/patient/{path}',[App\Http\Controllers\HomeController::class, 'indexuserPatient'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' )->middleware('page.role:Patient');