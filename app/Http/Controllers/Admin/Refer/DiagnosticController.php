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
                PatientDiagnostic::updateOrCreate([
                    'patient_information_id' => $patientInfo?->id,
                    'teeth_id' => $x,
                    'created_at' => null,
                ]);
            }
            $teeths = PatientDiagnostic::with('teeth.diseases', 'teethDisease')
                ->where('patient_information_id', $patientInfo?->id)
                ->get();
        }
        return response()->json($teeths);
    }
    

    public function childIndex($id){
        $patientInfo = PatientInformationRecord::find($id);
        $teeths = ChildDiagnostic::with('teeth.diseases', 'disease')
                    ->where('information_id', $patientInfo?->id)
                    ->get();

        if($teeths->count() < 1){
            for ($x = 1; $x <= 20; $x++) {
                ChildDiagnostic::updateOrCreate([
                    'information_id' => $patientInfo?->id,
                    'teeth_id' => $x,
                    'created_at' => null,
                ]);
            }
            $teeths = ChildDiagnostic::with('teeth.diseases', 'disease')
                ->where('information_id', $patientInfo?->id)
                ->get();
        }

        return response()->json($teeths);
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
                    'comments'=>$value['comments'],
                    'created_at'=>$value['created_at'],
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


    public function storeChild(Request $request, $id)
    {
        foreach ($request->all() as $value) {

            $diagnostic = ChildDiagnostic::where(
                [
                    'information_id'=>$value['information_id'],
                    'teeth_id'=>$value['teeth_id']
                ])->first();

            if ($diagnostic) {
                $diagnostic->update(
                    [
                        'disease_id'=>$value['disease_id'],
                        'comments'=>$value['comments'],
                        'created_at'=>$value['created_at'],
                    ]
                );
            }

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
            'message' => 'Child  Diagnostics saved successfully',
        ], 200);
    }

}
