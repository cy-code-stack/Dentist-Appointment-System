<?php

namespace App\Http\Controllers\Admin\Refer;

use App\Http\Controllers\Controller;
use App\Models\AdultTeeth;
use App\Models\PatientDiagnostic;
use App\Models\PatientInformationRecord;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function getPatientId(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer', 
        ]);

        $patient = PatientInformationRecord::where('user_id', $request->user_id)->first();

        if (!$patient) {
            return response()->json([
                'message' => 'Patient not found.',
            ], 404);
        }

        return response()->json([
            'patient_information_id' => $patient->id,
        ], 200);
    }
    public function index(){
        $teeths = AdultTeeth::with('diseases')->get();
        return response()->json($teeths);
    }
    
    public function store(Request $request)
    {
        $validData = $request->validate([
            '*.teeth_id' => 'nullable|integer',
            '*.disease_id' => 'nullable|integer',
            '*.comments' => 'nullable|string',  
        ]);

        $savedData = []; 

        foreach ($validData as $data) {
            $savedData[] = PatientDiagnostic::updateOrCreate(
                [
                    'teeth_id' => $data['teeth_id'],
                    'disease_id' => $data['disease_id'],
                ],
                [
                    'comments' => $data['comments'] 
                ]
            );
        }

        return response()->json([
            'message' => 'Teeth Diagnostics saved successfully',
            'data' => $savedData
        ], 200);
    }

}
