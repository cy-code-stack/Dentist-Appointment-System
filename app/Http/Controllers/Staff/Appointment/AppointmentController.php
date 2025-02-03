<?php

namespace App\Http\Controllers\Staff\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReschedAppointmentMail;
use App\Mail\AbortAppointmentMail;
use App\Models\PatientInformationRecord;
use App\Models\User;

class AppointmentController extends Controller
{
  

    /**
     * Store a newly created resource in storage.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($id){
        $appointment = Appointment::with('patient')->find($id);
        return response()->json([
            'id' => $appointment->id,
            'firstname' => $appointment->patient->firstname ?? '',
            'lastname' => $appointment->patient->lastname ?? '',
            'email' => $appointment->patient->email ?? '',
            'sched_date' => $appointment->sched_date,
            'sched_time' => $appointment->sched_time,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showAppointment(Request $request)
    {
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $status = $request->input('status');
        $search = $request->input('search', '');

        $query = Appointment::with('patient', 'appointServices')->whereNotIn('appnt_status', ['Pending', 'Declined', 'Archive', 'Payment', 'Completed'])->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('appnt_status', $status);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', function ($subQuery) use ($search) {
                    $subQuery->where('firstname', 'LIKE', "%{$search}%")
                             ->orWhere('lastname', 'LIKE', "%{$search}%");
                })
                ->orWhere('appnt_status', 'LIKE', "%{$search}%");
            });
        }

        $records = $query->paginate($limit, ['*'], 'page', $page);
                        
        return response()->json([
            'status' => 'success',
            'data' => $records->items(),
            'meta' => [
                'current_page' => $records->currentPage(),
                'last_page' => $records->lastPage(),
                'total' => $records->total(),
            ],
        ], 200);
    }

    public function approvedAppointment($id){
        $appointment = Appointment::with('appointServices')->findOrFail($id);
        $appointment->update([
            'appnt_status' => 'Approved',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Resched appointment successfully',
            'data' => $appointment,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */

    public function showPatient($id)
    {
        $appointment = Appointment::with('patient')->find($id);
        $patientInfo = PatientInformationRecord::with('user')->where('user_id', $appointment->patient_id)->get();
        if ($patientInfo->count() > 0) {
            return response()->json([
                'message' => 'Patient information retrieved successfully',
                'data' => $patientInfo
            ], 200);
        }
        if ($appointment) {
            $user = User::find($appointment->patient_id)->toArray();
            return response()->json([
                'message' => 'Appointment data retrieved successfully',
                'data' => [$user],
            ], 200);
        }
        return response()->json(['message' => 'Record not found'], 404);
    }

    public function recoAppointment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'appointment_id' => 'required|integer',
            'religion' => 'required',
            'place_of_birth' => 'required',   
            'nationality' => 'required',   
            'guardian' => 'required',   
            'referred_by' => 'required', 
            'chief_complaint' => 'required',   
            'previous_dentist' => 'required',   
            'last_dental_visit' => 'required',   
            'physician_name' => 'required',   
            'specialty' => 'required',   
            'office_address' => 'required',   
            'office_number' => 'required',   
            'good_health' => 'required',   
            'medical_treatment' => 'required',   
            'surgical_operation' => 'required',   
            'hospitalized' => 'required',   
            'prescribtion_non_rescribtion_medication' => 'required',   
            'tabacco_products' => 'required',   
            'dangerous_drugs' => 'required',   
            'allergy' => 'required',   
            'pregnant' => 'required',   
            'nursing_mother' => 'required',   
            'birth_control_pills' => 'required',   
            'blood_type' => 'required',   
            'blood_pressure' => 'required',   
            'health_problem' => 'required',   
        ]);

        $existingRecord = PatientInformationRecord::where('user_id', $validatedData['user_id'])->first();
        if ($existingRecord) {
            $existingRecord->update($validatedData);
        } else {
            $existingRecord = PatientInformationRecord::create($validatedData);
        }

        // Update the appointment status
        $appointmentRecord = Appointment::find($id);
        if ($appointmentRecord) {
            $appointmentRecord->appnt_status = 'Pending';
            $appointmentRecord->save();
        }

        return response()->json([
            'message' => $existingRecord->wasRecentlyCreated ? 'Information saved successfully' : 'Information updated successfully',
            'data' => $existingRecord,
        ], $existingRecord->wasRecentlyCreated ? 201 : 200);
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
