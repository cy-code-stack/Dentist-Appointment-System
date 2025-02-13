<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Services;
use App\Notifications\AppointmentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookAppointmentVerification;
use App\Models\PaymentAppointment;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function indexPatient(){
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();
        $unreadCount = $user->unreadNotifications->count();
        return view("Patient.Booking_Appointment", compact('notifications', 'unreadCount'));
    }

    public function storeAppointment(Request $request){

        $request->validate([
            'services_id' => 'required', 
            'sched_date' => 'required|date',
            'sched_time' => 'required', 
        ], [
            'services_id.required' => 'The services is required.',
            'sched_date.required' => 'The scheduled date is required.',
            'sched_date.date' => 'The scheduled date must be a valid date.',
            'sched_time.required' => 'The scheduled time is required.',
        ]);


        $appoint = $request->all();
        $appoint['patient_id'] = Auth::user()->id;
        $data = Appointment::create($appoint);

        $user_data = Appointment::with('patient', 'appointServices')->where('id', $data->id)->first();

        $bookmailData = [
            'name' => $user_data->patient->firstname. ' ' .$user_data->patient->lastname,
            'email' => $user_data->patient->email,
            'acc_create' => $user_data->patient->created_at,
            'services_name' => $user_data->appointServices->services_name,
            'time' => Carbon::parse($user_data->sched_date . ' ' . $user_data->sched_time)->format('l, F j, Y g:i A'),
            'status' => Str::headline($user_data->patient->status)
        ];

        $result = Mail::to($user_data->patient->email)->send(new BookAppointmentVerification($bookmailData));

        $users = User::where('role', 'Assistant')->get();

        foreach ($users as $user) {
            $user->notify(new AppointmentNotification($data));
        }

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Email sent successfully',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send email',
            ], 500);
        }
    }

    public function getRemainingSlots(Request $request)
    {
        $request->validate([
            'sched_date' => 'required|date',
        ]);
        $maxSlots = 20;
        $appointmentCount = Appointment::where('sched_date', $request->sched_date)->count();
        
        $remainingSlots = $maxSlots - $appointmentCount;

        return response()->json([
            'status' => 'success',
            'remaining_slots' => max(0, $remainingSlots),
        ], 200);
    }

    public function filterTime(Request $request)
    {
        $request->validate([
            'sched_date' => 'required|date',
        ]);
        $shedDate = $request->sched_date;
        $bookedTimes = Appointment::where('sched_date', $shedDate)
                                ->pluck('sched_time')
                                ->toArray();

        return response()->json([
            'status' => 'success',
            'available_times' => $bookedTimes,
        ], 200);
    }

    public function diplayServices(){
        $services = Services::where("serv_status", "Verified")->get();
        return $services;
    }

    public function getHistory()
    {
        $current_id = Auth::id();
        $record = PaymentAppointment::where('user_id', $current_id)->with('services')->get();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 201);
    }
}
