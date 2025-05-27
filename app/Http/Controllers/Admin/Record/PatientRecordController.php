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
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $search = $request->input('search', '');

        $query = Appointment::where('appnt_status', 'Completed')
            ->with(['appointServices', 'patient'])
            ->orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('patient', function ($subQuery) use ($search) {
                    $subQuery->where('firstname', 'like', "%{$search}%")
                            ->orWhere('lastname', 'like', "%{$search}%")
                            ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$search}%"]);
                })
                ->orWhereHas('appointServices', function ($subQuery) use ($search) {
                    $subQuery->where('services_name', 'like', "%{$search}%");
                });
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
        $data = PatientInformationRecord::where('user_id', $id)->with('appointment', 'user')->first();
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
