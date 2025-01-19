<?php

namespace App\Http\Controllers\Admin\Refer;

use App\Http\Controllers\Controller;
use App\Models\PatientInformationRecord;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PatientInformationController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $appointment = Appointment::with('patient')->find($id);
        $patientData = PatientInformationRecord::with('appointment', 'user')->where('user_id', $appointment->patient_id)->get();
        if ($patientData) {
            return response()->json([
                'message' => 'Patient data retrieved successfully',
                'data' => $patientData
            ], 200);
        }
        return response()->json(['message' => 'Record not found'], 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateInformation(Request $request, $id)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'apppointment_id' => 'nullable|integer',
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
            'health_problem' => 'required' 
        ]);

        $record = PatientInformationRecord::with('user', 'appointment')->find($id);
        $record->update($data);

        return response()->json([
            'message' => 'Information saved successfully',
            'data' => $record
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientInformationRecord $patientInformationRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatientInformationRecord $patientInformationRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientInformationRecord $patientInformationRecord)
    {
        //
    }
}
