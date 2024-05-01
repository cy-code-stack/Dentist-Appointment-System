<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function indexPatient(){
        return view("Patient.Booking_Appointment");
    }
}
