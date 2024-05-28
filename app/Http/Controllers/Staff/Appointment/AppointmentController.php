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
    public function update(Request $request, string $id)
    {
        //
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
}
