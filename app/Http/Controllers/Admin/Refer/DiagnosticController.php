<?php

namespace App\Http\Controllers\Admin\Refer;

use App\Http\Controllers\Controller;
use App\Models\AdultTeeth;
use App\Models\ChildDiagnostic;
use App\Models\ChildTeeth;
use App\Models\PatientDiagnostic;
use App\Models\PatientInformationRecord;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function index($id){
        $patientInfo = PatientInformationRecord::find($id);
        $teeths = PatientDiagnostic::with('teeth.diseases', 'teethDisease')
                ->where('patient_information_id', $patientInfo?->id)
                ->get();
        if($teeths->count() < 1){
            for ($x = 1; $x <= 32; $x++) {
                PatientDiagnostic::create([
                    'patient_information_id' => $patientInfo?->id,
                    'teeth_id' => $x,
                ]);
            }
            $teeths = PatientDiagnostic::with('teeth.diseases', 'teethDisease')
                ->where('patient_information_id', $patientInfo?->id)
                ->get();
        }
        return response()->json($teeths);
    }
    

    public function childIndex(){
        $childTeeth = ChildTeeth::with('diseases')->get();
        return response()->json($childTeeth);
    }

    
    public function store(Request $request, $id)
    {
        foreach ($request->all() as $value) {
        
            PatientDiagnostic::where(
                [
                    'patient_information_id'=>$value['patient_information_id'],
                    'teeth_id'=>$value['teeth_id']
                ])->first()->update(
                [
                    'disease_id'=>$value['disease_id'],
                    'comments'=>$value['comments']
                ]);
        }

        $record = PatientInformationRecord::with('appointment')
            ->where('id', $id)
            ->first();

        if ($record && $record->appointment) {
            $record->appointment->update([
                'appnt_status' => 'Payment'
            ]);
        }

        return response()->json([
            'message' => 'Teeth Diagnostics saved successfully',
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
