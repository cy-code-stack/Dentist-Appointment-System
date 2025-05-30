<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Staff\StaffController; 

## Landing page
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PrintController;

## Patient
use App\Http\Controllers\Patient\CalendarEvt\CalendarEventControllerPatient;
use App\Http\Controllers\Patient\View_Appointment\ViewAppointmentController;
use App\Http\Controllers\Patient\Profile\PatientProfileController;

## Admin
use App\Http\Controllers\Admin\AdminDashboardController; 
use App\Http\Controllers\Admin\Manage_Services\ManageServicesController; 
use App\Http\Controllers\Admin\Managing_Staff\ManageStaffController; 
use App\Http\Controllers\Admin\Refer\AdminReferPatientsController; 
use App\Http\Controllers\Admin\Archive\AdminArchiveController;
use App\Http\Controllers\Admin\Calendar\AdminCalendarController;
use App\Http\Controllers\Admin\Payments\PaymentsController;
use App\Http\Controllers\Admin\Profile\AdminProfileController;
use App\Http\Controllers\Admin\Record\PatientRecordController;
use App\Http\Controllers\Admin\Refer\PatientInformationController;
use App\Http\Controllers\Admin\Refer\DiagnosticController;
use App\Http\Controllers\Admin\Transaction\TransactionController;
use App\Http\Controllers\Admin\Patient\ManagePatientController;

## Assistant
use App\Http\Controllers\Staff\Managing_User\ManageUserController;
use App\Http\Controllers\Staff\Appointment\AppointmentController;
use App\Http\Controllers\Staff\Archieve\ArchieveController;
use App\Http\Controllers\Staff\Inquiry\InquiryController;
use App\Http\Controllers\Staff\CalendarEvent\CalendarEventController;
use App\Http\Controllers\Staff\History\PatientHistoryController;
use App\Http\Controllers\Staff\Payment\StaffPaymentController;
use App\Http\Controllers\Staff\Profile\AssistantProfileController;


Route::get('/', function () { return view('landing_page');});
    
Route::post('/inquiries/store', [LandingPageController::class, 'makeInquiry'])->name('inquiries.store');
    
Route::get('/user/signin', [Authentication::class, 'index'])->name('signin');
Route::post('/user/auth', [Authentication::class, 'loginUsers'])->name('authenticate');

Route::get('/user/signup', [Authentication::class, 'indexSignup'])->name('signup');
Route::post('/storeData', [Authentication::class,'submitUser'])->name('storeData');

Route::get('/verify/otp', [Authentication::class, 'indexVerify'])->name('verify');
Route::post('/verify/user/acc', [Authentication::class, 'otpVerify'])->name('acc-verify');
Route::post('/resend-otp', [Authentication::class, 'resend'])->name('resend-otp');

Route::get('/user/forgot', [Authentication::class, 'indexForgot'])->name('forgot');
Route::post('/user/forgot/acc', [Authentication::class, 'indexForgotAcc'])->name('user-forgot');
Route::get('/user/reset/index/{token}', [Authentication::class, 'resetPass'])->name('reset');
Route::post('/user/change/pass', [Authentication::class, 'changePass'])->name('changePass');

Route::get('/user/logout', [Authentication::class, 'logout'])->name('logout');


Route::get('/user/view/history/{id}', [PatientHistoryController::class, 'index']);


## Print
Route::get('/patient/invoice/print/{id}', [PrintController::class, 'downloadPrint'])->name('invoive.print');
Route::get('/patient/patient-history/print/{id}', [PrintController::class, 'downloadPatientHistory'])->name('patient-history.print');
Route::get('/patient/appointment/print/{id}', [PrintController::class, 'printAppointmentHistory'])->name('appointment.print');
Route::get('/print/consolidated-report', [PrintController::class, 'printConsolidatedReport'])->name('report.print');


Route::post('/notifications/mark-as-read', [App\Http\Controllers\HomeController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/notifications/mark-all-read', [App\Http\Controllers\HomeController::class, 'markAllRead'])->name('notifications.markAllRead');

## Routes for authenticated users
Route::middleware(['preventBackHistory', 'auth'])->group(function () {

    Route::middleware(['patient'])->group(function(){
        ## Main Routes
        Route::get('/user/patient/booking', [PatientController::class, 'indexPatient'])->name('appointment');

        ## Book Appointment Section
        Route::post('/user/patient/setAppointment', [PatientController::class, 'storeAppointment']);
        Route::get('/user/patient/displayAppointment', [PatientController::class, 'diplayServices']);
        Route::get('/user/patient/countAppointment', [PatientController::class, 'getRemainingSlots']);
        Route::get('/user/patient/filterTime', [PatientController::class, 'filterTime']);
        Route::get('/user/patient/history/get', [PatientController::class, 'getHistory']);

        ## Start of Calendar Event Routes
        Route::get('/user/patient/display/event', [CalendarEventControllerPatient::class, 'displayEvnt']);
        Route::get('/user/patient/display/appointment', [CalendarEventControllerPatient::class, 'displayAppointment']);

        ## Start of View Appointment Routes
        Route::get('/user/patient/appointment/view', [ViewAppointmentController::class,'displayAppointmentDate']);
        Route::put('/user/patient/appointment/view/{id}', [ViewAppointmentController::class,'displayAppointmentInfo']);
        Route::put('/user/patient/appointment/decline/{id}', [ViewAppointmentController::class,'declineAppointment']);
        Route::get('/user/patient/appointment/view/decline', [ViewAppointmentController::class,'declineListApp']);

        ## Start of Profile Page
        Route::get('/user/patient/profile/displayUser', [PatientProfileController::class,'displayInfo']);
        Route::post('/user/patient/profile/uploadImage', [PatientProfileController::class,'uploadImage']);
        Route::delete('/user/patient/profile/deleteUser', [PatientProfileController::class,'destroyPatientUser']);
        Route::delete('/user/patient/profile/deleteImage', [PatientProfileController::class,'removePatientImg']);
        Route::put('/user/patient/profile/updateProfile/{id}', [PatientProfileController::class,'updatePatientProfile']);
        Route::post('/user/patient/profile/change_pass', [PatientProfileController::class,'updatePatientPassword']);
    });
    

    Route::middleware(['admin'])->group(function() {
        ## Primary Route
        Route::get('/user/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin');
        Route::get('/user/admin/count', [AdminDashboardController::class, 'countPatient']);
        Route::get('/user/admin/sales/count', [AdminDashboardController::class, 'sales']);
        Route::get('/user/admin/appointment/percentage', [AdminDashboardController::class, 'getAppointmentPercentageEachMonth']);
        Route::get('/user/admin/appointment/top', [AdminDashboardController::class, 'getTopServicesEachAppointment']);
        Route::get('/user/admin/patient/demographics', [AdminDashboardController::class, 'demographics']);
        Route::get('/user/admin/patient/patientCount', [AdminDashboardController::class, 'patientCount']);
        Route::get('/user/admin/services/adminCountServices', [AdminDashboardController::class, 'countServices']);
        Route::get('/user/admin/transtraction/adminTransactionCount', [AdminDashboardController::class, 'countTransaction']);
        Route::get('/user/admin/assistant/assistantCount', [AdminDashboardController::class, 'assistantCount']);
        Route::get('/user/admin/appointment/daily', [AppointmentController::class, 'getDailyAppointments']);

        ## Manage Staff
        Route::get('/user/admin/manage/user', [ManageStaffController::class, 'showUser']);
        Route::post('/user/admin/user/add', [ManageStaffController::class,'storeUser']);
        Route::put('/user/admin/user/verify/{id}', [ManageStaffController::class,'verifyUser']);
        Route::put('/user/admin/user/update/{id}', [ManageStaffController::class,'updateUser']);
        Route::put('/user/admin/staff/archive/{id}', [ManageStaffController::class, 'archiveStaff']);

        ## Manage Patient
        Route::get('/user/admin/patient/display', [ManagePatientController::class, 'showUser']);
        Route::post('/user/admin/patient/add', [ManagePatientController::class,'storeUser']);
        Route::put('/user/admin/patient/verify/{id}', [ManagePatientController::class,'verifyUser']);
        Route::put('/user/admin/patient/update/{id}', [ManagePatientController::class,'updateUser']);
        Route::put('/user/admin/patient/archieve/{id}' , [ManagePatientController::class,'archieveUser']);

        ## Manage Services
        Route::post('/admin/services/add', [ManageServicesController::class, 'storeService']);
        Route::get('/admin/display/data', [ManageServicesController::class, 'showServices']);
        Route::put('/admin/services/edit/{id}', [ManageServicesController::class, 'updateServices']);
        Route::put('/admin/services/archive/{id}', [ManageServicesController::class, 'archiveServices']);

        ## Transaction Patients
        Route::get('/admin/patients/refer', [AdminReferPatientsController::class, 'getVerifiedPatients']);
        Route::get('/admin/patients/index/{id}', [PatientInformationController::class, 'index']);
        Route::get('/admin/patients/show/{id}', [PatientInformationController::class, 'show']);
        Route::put('/admin/patient/archive/{id}', [AdminReferPatientsController::class, 'archiveReferPatients']);
        Route::put('/admin/patients/information/{id}', [PatientInformationController::class, 'updateInformation']);
        Route::get('/admin/patients/diagnostic/{id}', [DiagnosticController::class, 'index']);
        Route::get('/admin/patients/child/{id}', [DiagnosticController::class, 'childIndex']);
        Route::put('/admin/patients/diagnostic/store/{id}', [DiagnosticController::class, 'store']);
        Route::put('/admin/patients/child/store/{id}', [DiagnosticController::class, 'storeChild']);

        ## Payments
        Route::get('/admin/patients/payment/show/{id}', [PaymentsController::class, 'show']);
        Route::post('/admin/patients/pay/store', [PaymentsController::class, 'store']);
        Route::post('/admin/patients/pay/item', [PaymentsController::class, 'addPayment']);
        Route::get('/admin/patients/payment/history/show/{id}', [PaymentsController::class, 'getPaymentHistory']);
        Route::get('/admin/patients/display/services', [PaymentsController::class, 'diplayServices']);
        Route::put('/admin/patients/transaction/complete/{id}', [PaymentsController::class, 'completeTransaction']);

        ## Callendar Event Page Section
        Route::get('/admin/calendar/display/events', [AdminCalendarController::class, 'displayEvent']);
        Route::get('/admin/calendar/display/appointments', [AdminCalendarController::class, 'displayAppointment']);

        ## Archive Page Section
        Route::get('/admin/staff/archive/display', [AdminArchiveController::class, 'showStaffArchive']);
        Route::get('/admin/refer/archive', [AdminArchiveController::class, 'showReferArchive']);
        Route::get('/admin/services/archive', [AdminArchiveController::class, 'showServicesArchive']);
        Route::put('/admin/staff/restore/{id}', [AdminArchiveController::class, 'restoreArchiveStaff']);
        Route::put('/admin/services/restore/{id}', [AdminArchiveController::class, 'restoreArchiveServices']);
        Route::put('/admin/refer/restore/{id}', [AdminArchiveController::class, 'restoreArchiveRefer']);

        ## Profile Page Section
        Route::get('/admin/profile/user', [AdminProfileController::class,'getProfileInfo']);
        Route::put('/admin/profile/update/{id}', [AdminProfileController::class,'updateProfile']);
        Route::post('/admin/profile/upload', [AdminProfileController::class,'uploadAvatar']);
        Route::delete('/admin/profile/destroy', [AdminProfileController::class,'removeImg']);
        Route::post('/admin/profile/changePass', [AdminProfileController::class,'updatePassword']);
        Route::delete('/admin/profile/userDestroy', [AdminProfileController::class,'destroyUser']);
    });  
    
    Route::middleware(['assistant'])->group(function(){

        ## Primary routes
        Route::get('/user/staff/dashboard', [StaffController::class, 'index'])->name('staff');
        Route::get('/user/staff/patient/appointmentCount', [StaffController::class, 'countAppointmentCatered']);
        Route::get('/user/staff/services/servicesCount', [StaffController::class, 'countServices']);
        Route::get('/user/staff/appointment/ongoingCount', [StaffController::class, 'countOngoingAppointment']);
        Route::get('/user/staff/appointment/declinedCount', [StaffController::class, 'countDeclinedAppointment']);
        Route::get('/user/staff/appointment/dashboardDisplay', [StaffController::class, 'displayAppointment']);

        ## Adding Walk-in Applicant Routes
        Route::post('/user/staff/walkin/applicant/add', [AppointmentController::class, 'addWalkInApplicant']);
        Route::get('/user/staff/patient/show', [AppointmentController::class, 'patient']);
        Route::get('/user/staff/service/show', [AppointmentController::class, 'service']);

        ## Manage User
        Route::get('/user/staff/manage/user', [ManageUserController::class, 'showUser']);
        Route::post('/user/staff/user/add', [ManageUserController::class,'storeUser']);
        Route::put('/user/staff/user/verify/{id}', [ManageUserController::class,'verifyUser']);
        Route::put('/user/staff/user/update/{id}', [ManageUserController::class,'updateUser']);
        Route::put('/user/staff/user/archieve/{id}' , [ManageUserController::class,'archieveUser']);

        ## Start of Appointment Routes
        Route::get('/user/staff/appointment/resched/view/{id}', [AppointmentController::class,'index']);
        Route::get('/user/staff/appointment/display', [AppointmentController::class, 'showAppointment']);
        Route::get('/user/staff/appointment/patient/view/{id}', [AppointmentController::class,'showPatient']);
        Route::put('/user/staff/recomend/doctor/{id}', [AppointmentController::class, 'recoAppointment']);
        Route::put('/user/staff/appointment/abort/{id}', [AppointmentController::class, 'abortAppointment']);
        Route::put('/user/staff/appointment/resched/{id}', [AppointmentController::class,'reschedAppointment']);
        Route::put('/user/staff/appointment/approved/{id}', [AppointmentController::class,'approvedAppointment']);

        ## Start of Calendar Event Routes
        Route::get('/user/staff/event/display', [CalendarEventController::class, 'index']);
        Route::post('/user/staff/event/store', [CalendarEventController::class, 'storeEvent']);
        Route::get('/user/staff/calendar/display/appointment', [CalendarEventController::class, 'displayAppointment']);

        ## Payment Section
        Route::get('/user/staff/payment/display/{id}', [StaffPaymentController::class, 'show']);
        Route::get('/user/staff/services/servDisplay', [StaffPaymentController::class, 'services']);
        Route::post('/user/staff/payment/store', [StaffPaymentController::class, 'store']);
        Route::get('/user/staff/history/payment/{id}', [StaffPaymentController::class, 'getPaymentHistory']);
        Route::post('/user/staff/add/payment/item', [StaffPaymentController::class, 'addPayment']);
        Route::put('/user/staff/appointment/complete/{id}',[StaffPaymentController::class, 'completeTransaction']);

        ## Start of Inquiry Section
        Route::get('/user/staff/inquiry/display', [InquiryController::class, 'displayInquiry']);
        Route::put('/user/staff/inquiry/send/{id}', [InquiryController::class, 'replyInquiry']);
        Route::put('/user/staff/inquiry/alreadyCatered/{id}', [InquiryController::class, 'alreadyCatered']);

        ## Archieve Section
        Route::get('/user/staff/archieve/display', [ArchieveController::class, 'showArchieve']);
        Route::put('/user/staff/archieve/restore/{id}', [ArchieveController::class, 'updateArchieve']);
        Route::get('/user/staff/appointment/declined', [ArchieveController::class, 'showAppointmentDeclined']);

        ## Transaction Section
        Route::get('/user/staff/transaction/display', [TransactionController::class, 'show']);

        ## Patient Records Section 
        Route::get('/user/staff/display', [PatientRecordController::class, 'index']);
        Route::get('/user/staff/view/{id}', [PatientRecordController::class, 'show']);
        Route::get('/user/staff/diagnostic/{id}', [PatientRecordController::class, 'showDiagnostic']);

        ## Start of Profile Section
        Route::post('/user/staff/profile/upload', [AssistantProfileController::class, 'uploadImage']);
        Route::get('/user/staff/profile/display', [AssistantProfileController::class,'displayProfile']);
        Route::put('/user/staff/profile/update/{id}', [AssistantProfileController::class,'updateAssistantProfile']);
        Route::delete('/user/staff/profile/removeAvatar', [AssistantProfileController::class,'removeAvatar']);
        Route::post('/user/staff/profile/passChange', [AssistantProfileController::class,'changePassword']);
        Route::delete('/user/staff/profile/destroy', [AssistantProfileController::class,'destroyUserCred']);
    });
});



// Restricted Routes
    Route::get('/user/admin/{path}',[App\Http\Controllers\HomeController::class, 'adminIndex'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' )->middleware('page.role:Dentist');
    Route::get('/user/staff/{path}',[App\Http\Controllers\HomeController::class, 'index'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' )->middleware('page.role:Assistant');
    Route::get('/user/patient/{path}',[App\Http\Controllers\HomeController::class, 'indexuserPatient'])->where('any','^(?!js/).*')->where( 'path', '([A-z\d\-/_.]+)?' )->middleware('page.role:Patient');