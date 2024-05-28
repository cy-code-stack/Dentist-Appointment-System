<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Services;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

        return response()->json([
            'message' => 'Appointment created successfully', 
            'appointment' => $data,
        ], 200);
    }

    public function diplayServices(){
        return Services::all();
    }
}
