<?php

namespace App\Http\Controllers\Patient\CalendarEvt;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\CalendarEvent;

class CalendarEventControllerPatient extends Controller
{
    // public function displayEvnt(){
    //     $data = CalendarEvent::all();
    //     return $data;
    // }

    public function displayAppointment(){
        $data = Appointment::with('patient', 'appointServices')->where('appnt_status', '<>', 'Declined')->get();
        return $data;
    }
}
