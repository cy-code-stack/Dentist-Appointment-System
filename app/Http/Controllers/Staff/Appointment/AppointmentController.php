<?php

namespace App\Http\Controllers\Staff\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReschedAppointmentMail;
use App\Mail\AbortAppointmentMail;
use App\Models\PatientInformationRecord;
use App\Models\Services;
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

    public function getDailyAppointments(Request $request)
    {
        $date = $request->input('date', now()->format('Y-m-d'));
        $appointments = Appointment::with('patient', 'appointServices')
            ->whereDate('sched_date', $date)
            ->orderBy('sched_time', 'asc')
            ->get()
            ->map(function ($appointment) {
                return [
                    'id' => $appointment->id,
                    'patient_name' => $appointment->patient->firstname . ' ' . $appointment->patient->lastname,
                    'sched_time' => $appointment->sched_time,
                    'services' => $appointment->appointServices?->services_name,
                    'status' => $appointment->appnt_status,
                    'type' => $appointment->type,
                    'amount' => $appointment->appointServices?->price,
                ];
            });

        if ($appointments->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No appointments found for the selected date.',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $appointments,
        ], 200);
    }

    ## Add Walk In
    public function addWalkInApplicant(Request $request){
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'services_id' => 'required|exists:services,id',
            'sched_date' => ['required', 'date'],
            'sched_time' => 'required|date_format:H:i',
        ], [
            'patient_id.required' => 'The patient ID is required.',
            'patient_id.exists' => 'The selected patient does not exist.',
            'services_id.required' => 'The service ID is required.',
            'services_id.exists' => 'The selected service does not exist.',
            'sched_date.required' => 'The scheduled date is required.',
            'sched_date.date' => 'The scheduled date must be a valid date.',
            'sched_time.required' => 'The scheduled time is required.',
            'sched_time.date_format' => 'The scheduled time must be in the format HH:MM.',
        ]);

        try {
            $data = $request->all();
            $appointment = Appointment::create($data);
            $appointment->type = 'Walk-in';
            return response()->json([
                'status' => 'success',
                'message' => 'Walk-in applicant created successfully.',
                'data' => $appointment,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Walk-in applicant creation failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    ## Show Patient
    public function patient(){
        $user = User::whereNotIn('role', ['Assistant', 'Dentist'])->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Patient Displayed Successfully',
            'data' => $user,
        ], 200);
    }

    public function service(){
        $service = Services::where('serv_status', 'Verified')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Patient Services Successfully',
            'data' => $service,
        ], 200);
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

        $query = Appointment::with('patient', 'appointServices')
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('appnt_status', $status);
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', function ($subQuery) use ($search) {
                    $subQuery->where('firstname', 'LIKE', "%{$search}%")
                            ->orWhere('lastname', 'LIKE', "%{$search}%")
                            ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$search}%"]);
                });
            });
        } else {
            $query->whereNotIn('appnt_status', ['Pending', 'Declined', 'Archive', 'Completed']);
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
