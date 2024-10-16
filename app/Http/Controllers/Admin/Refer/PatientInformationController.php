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
            'user_id' => 'nullable|integer',
            'appointment_id' => 'nullable|integer',
            'birthdate' => 'nullable|date',
            'religion' => 'nullable',   
            'place_of_birth' => 'nullable',   
            'nationality' => 'nullable',   
            'guardian' => 'nullable',   
            'reffered_by' => 'nullable',   
            'chief_complaint' => 'nullable',   
            'previous_dentist' => 'nullable',   
            'last_dental_visit' => 'nullable',   
            'physician_name' => 'nullable',   
            'specialty' => 'nullable',   
            'office_address' => 'nullable',   
            'office_number' => 'nullable',   
            'good_health' => 'nullable',   
            'medical_treatment' => 'nullable',   
            'surgical_operation' => 'nullable',   
            'hospitalized' => 'nullable',   
            'prescribtion_non_rescribtion_medication' => 'nullable',   
            'tabacco_products' => 'nullable',   
            'dangerous_drugs' => 'nullable',   
            'allergy' => 'nullable',   
            'pregnant' => 'nullable',   
            'nursing_mother' => 'nullable',   
            'birth_control_pills' => 'nullable',   
            'blood_type' => 'nullable',   
            'blood_pressure' => 'nullable',   
            'health_problem' => 'nullable',   
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
