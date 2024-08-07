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
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     */
    public function showAppointment()
    {
        $appointment = Appointment::with('patient', 'appointServices')
                        ->whereNotIn('appnt_status', ['Ongoing', 'Declined', 'Archive'])
                        ->get();
                        
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



    // public function abortAppointment(Request $request){
    //     $appoint = $request->all();
    //     $appoint['appnt_status'] = 'Declined';

    //     $data = Appointment::create($appoint);

    //     return $data;
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroyAppointment($id)
    // {
    //     $appoint = Appointment::findOrFail($id);
    //     $appoint->delete();
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Appointment deleted successfully',
    //     ], 200);
    // }

    public function abortAppointment(Request $request, $id){
        $appoint = Appointment::findOrFail($id);
        $request['appnt_status'] = 'Declined';
        $appoint->abort_reason = $request->abort_reason;
        $appoint->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Appointment aborted successfully',
            'data' => $appoint,
        ], 200);
    }

    public function reschedAppointment(Request $request, $id)  {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Resched appointment successfully',
            'data' => $appointment,
        ], 200);
    }

}
