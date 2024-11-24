<?php

namespace App\Http\Controllers\Admin\Calendar;

use App\Http\Controllers\Controller;
use App\Models\CalendarEvent;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminCalendarController extends Controller
{
    public function displayEvent(){
        $data = CalendarEvent::all();
        return $data;
    }

    public function displayAppointment(){
        $data = Appointment::with('patient', 'appointServices')->where('appnt_status', '<>', 'Declined')->get();
        return $data;
    }
}
