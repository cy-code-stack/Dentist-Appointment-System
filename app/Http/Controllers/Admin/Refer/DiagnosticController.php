<?php

namespace App\Http\Controllers\Admin\Refer;

use App\Http\Controllers\Controller;
use App\Models\AdultTeeth;
use App\Models\Appointment;
use App\Models\ChildDiagnostic;
use App\Models\ChildTeeth;
use App\Models\PatientDiagnostic;
use App\Models\PatientInformationRecord;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function index(){
        $teeths = AdultTeeth::with('diseases')->get();
        return response()->json($teeths);
    }

    public function childIndex(){
        $childTeeth = ChildTeeth::with('diseases')->get();
        return response()->json($childTeeth);
    }

    
    public function store(Request $request)
    {
        $validData = $request->validate([
            '*.patient_information_id' => 'nullable|integer',
            '*.teeth_id' => 'nullable|integer',
            '*.disease_id' => 'nullable|integer',
            '*.comments' => 'nullable|string',  
        ]);

        $savedData = [];

        foreach ($validData as $data) {
            $savedData[] = PatientDiagnostic::create([
                'patient_information_id' => $data['patient_information_id'],
                'teeth_id' => $data['teeth_id'],
                'disease_id' => $data['disease_id'],
                'comments' => $data['comments'],
            ]);
        }

        $record = PatientInformationRecord::with('appointment')
            ->where('id', $validData[0]['patient_information_id'] ?? null)
            ->first();

        if ($record && $record->appointment) {
            $record->appointment->update([
                'appnt_status' => 'Payment'
            ]);
        }

        return response()->json([
            'message' => 'Teeth Diagnostics saved successfully',
            'data' => $savedData
        ], 200);
    }   


    public function storeChild(Request $request)
    {
        $validData = $request->validate([
            '*.information_id' => 'nullable|integer',
            '*.teeth_id' => 'nullable|integer',
            '*.disease_id' => 'nullable|integer',
            '*.comments' => 'nullable|string',  
        ]);

        $savedData = []; 

        foreach ($validData as $data) {
            $savedData[] = ChildDiagnostic::create(
                [
                    'information_id' => $data['information_id'],
                    'teeth_id' => $data['teeth_id'],
                    'disease_id' => $data['disease_id'],
                    'comments' => $data['comments'],
                ],
            );
        }


        return response()->json([
            'message' => 'Child  Diagnostics saved successfully',
            'data' => $savedData
        ], 200);
    }

}
