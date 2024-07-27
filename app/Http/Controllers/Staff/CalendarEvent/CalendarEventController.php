<?php

namespace App\Http\Controllers\Staff\CalendarEvent;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        return response()->json(CalendarEvent::all());
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'event_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ],[
            'event_name.required' => 'This field is required',
            'start_date.required' => 'This field is required',
            'end_date.required' => 'This field is required',
        ]);
        $data = $request->all();
        $event = CalendarEvent::create($data);
        return response()->json($event, 201);
    }

    public function displayAppointment(){
        $data = Appointment::with('patient')->get();
        return $data;
    }
}
