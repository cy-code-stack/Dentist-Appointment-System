<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookAppointmentVerification;

class PatientController extends Controller
{
    public function indexPatient(){
        return view("Patient.Booking_Appointment");
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
        $appoint['patient_id'] = \Auth::user()->id;
        $data = Appointment::create($appoint);

        $user_data = Appointment::with('patient', 'services')->where('id', $data->id)->first();

        $bookmailData = [
            'main-title' => 'Booking Appointment Successfuly Done',
            'title' => 'Your Appointment is set Successfuly you may go to the clinic and present it to the Assistant for confirmation.
                        Note: This is First Come, First Serve Basis. Thank you',
            'name' => $user_data->patient->firstname. ' ' .$user_data->patient->lastname,
            'email' => $user_data->patient->email,
            'acc_create' => $user_data->patient->created_at,
            'services_name' => $user_data->services->services_name,
            'time' => $user_data->sched_date. ' ' .$user_data->sched_time,
            'status' => $user_data->patient->status
        ];

        $result = Mail::to($user_data->patient->email)->send(new BookAppointmentVerification($bookmailData));

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'User verified and email sent successfully',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send email',
            ], 500);
        }
    }

    public function diplayServices(){
        return Services::all();
    }
}
