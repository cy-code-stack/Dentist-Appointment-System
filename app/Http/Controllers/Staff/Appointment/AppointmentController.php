<?php

namespace App\Http\Controllers\Staff\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReschedAppointmentMail;
use App\Mail\AbortAppointmentMail;

class AppointmentController extends Controller
{
  

    /**
     * Store a newly created resource in storage.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     */
    public function showAppointment()
    {
        $appointment = Appointment::with('patient', 'appointServices')
                        ->whereNotIn('appnt_status', ['Ongoing', 'Declined', 'Archive'])
                        ->get();
                        
        return $appointment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function recoAppointment(Request $request, $id)
    {
        $appoint = Appointment::findOrFail($id);
        $request['appnt_status'] = 'Ongoing';
        $appoint->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment updated successfully',  $appoint,
        ], 200);
    }

    public function abortAppointment(Request $request, $id)
    {
        $request->validate([
            'abort_reason' => 'required|string',
        ],[
            'abort_reason.required' => 'This field is required',
            'abort_reason.string' => 'The reason must be a string',
        ]);
    
        $appoint = Appointment::with('appointServices')->findOrFail($id);
    
       
        $appoint->appnt_status = 'Declined';
        $appoint->abort_reason = $request->input('abort_reason'); 
        $appoint->save(); 
    
        $patient = $appoint->patient;
        if ($patient) {
            Mail::to($patient->email)->send(new AbortAppointmentMail($appoint));
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Appointment aborted successfully',
            'data' => $appoint,
        ], 200);
    }
    

    public function reschedAppointment(Request $request, $id)  {
        $appointment = Appointment::with('appointServices')->findOrFail($id);
        $appointment->update($request->all());

        $patient = $appointment->patient;
        if ($patient) {
            Mail::to($patient->email)->send(new ReschedAppointmentMail($appointment));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Resched appointment successfully',
            'data' => $appointment,
        ], 200);
    }

}
