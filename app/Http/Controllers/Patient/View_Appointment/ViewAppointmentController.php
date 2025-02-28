<?php

namespace App\Http\Controllers\Patient\View_Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewAppointmentController extends Controller
{
    public function displayAppointmentDate(){
        $userId = Auth::user()->id;
        $data = Appointment::where('patient_id', $userId)
                            ->where('appnt_status', '!=', 'Declined')
                            ->with('appointServices', 'patient')
                            ->orderBy('created_at', 'desc')
                            ->get();
        return $data;
    }

    public function displayAppointmentInfo($id){
        $data = Appointment::with('appointServices', 'patient')->findOrFail($id);
        return response()->json($data);
    }

    public function declineAppointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'error' => 'Appointment not found',
            ], 404);
        }

        if ($request->has('reason')) {
            $appointment->appnt_status = 'Declined'; 
            $appointment->abort_reason = $request->input('reason');
            $appointment->save();

            return response()->json([
                'message' => 'Appointment decline successfully',
            ]);
        }

        return response()->json([
            'error' => 'Reason is required for cancellation',
        ], 400);
    }

    public function declineListApp()
    {
        $userId = Auth::user()->id;
        $record = Appointment::where('patient_id', $userId)
            ->where('appnt_status', 'Declined')
            ->with('appointServices', 'patient')
            ->get();
        return $record;
    }

}
