<?php

namespace App\Http\Controllers\Staff\Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
  

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
    public function showAppointment()
    {
        $appointment = Appointment::with('patient', 'services')->get();
        return $appointment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function recoAppointment(Request $request, $id)
    {
        $appoint = Appointment::findOrFail($id);
        $request['appnt_status'] = 'Ongoing';
        $appoint->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment updated successfully',  $appoint,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAppointment($id)
    {
        $appoint = Appointment::findOrFail($id);
        $appoint->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Appointment deleted successfully',
        ], 200);
    }

    public function abortAppointment(Request $request, $id){
        $appoint = Appointment::findOrFail($id);
        $request['appnt_status'] = 'Declined';
        $appoint->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment updated successfully',  $appoint,
        ], 200);
    }
}
