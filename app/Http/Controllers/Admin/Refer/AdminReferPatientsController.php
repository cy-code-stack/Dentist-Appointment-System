<?php

namespace App\Http\Controllers\Admin\Refer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminReferPatientsController extends Controller
{
    public function getVerifiedPatients(){
        $verifiedPatients = Appointment::where('appnt_status', '=', 'Ongoing')->with('services', 'patient')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $verifiedPatients,
        ], 200);
    }
}
