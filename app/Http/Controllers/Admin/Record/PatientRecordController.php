<?php

namespace App\Http\Controllers\Admin\Record;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PatientDiagnostic;
use App\Models\PatientInformationRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $record = Appointment::where('appnt_status', 'Completed')->with('appointServices', 'patient')->get();
        return response()->json([
            'status' => 'success',
            'data' => $record,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PatientInformationRecord::with('appointment', 'user')->find($id);
        if (!$data) {
            return response()->json(['message' => 'Patient not found'], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function showDiagnostic($id){
        $teeth = PatientDiagnostic::where('patient_information_id', $id)->with('teeth', 'teethDisease')->get();
        if (!$teeth) {
            return response()->json(['message' => 'Diagnostic not found'], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $teeth,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
