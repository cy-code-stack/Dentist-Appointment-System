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
        $info = Appointment::with('patient')->find($id);
        if (!$info) {
            return response()->json(['message' => 'Patient not found'], 404);
        }
        return response()->json($info);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'appointment_id' => 'required|integer',
            'birthdate' => 'required|date',
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

        $data = PatientInformationRecord::create($validatedData);

        return response()->json([
            'message' => 'Information saved successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $record = PatientInformationRecord::where('user_id', $id)->first();
        // if (!$record) {
        //     return response()->json(['message' => 'Patient not found'], 404);
        // }
        // return response()->json($record);
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
