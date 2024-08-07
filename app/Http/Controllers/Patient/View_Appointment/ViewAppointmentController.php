<?php

namespace App\Http\Controllers\Patient\View_Appointment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Auth;

class ViewAppointmentController extends Controller
{
    public function displayAppointmentDate(){
        $userId = Auth::user()->id;
        $data = Appointment::where('patient_id', $userId)
                            ->with('appointServices', 'patient')
                            ->orderBy('services_id','DESC')
                            ->get();
        return $data;
    }

    public function displayAppointmentInfo($id){
        $data = Appointment::with('appointServices', 'patient')->findOrFail($id);
        return response()->json($data);
    }

}
