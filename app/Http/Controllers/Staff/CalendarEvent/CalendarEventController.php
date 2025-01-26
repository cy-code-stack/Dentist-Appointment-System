<?php

namespace App\Http\Controllers\Staff\CalendarEvent;

use App\Events\AppointmentBlockEvent;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\CalendarEvent;
use App\Models\User;
use App\Notifications\BlockAppointment;
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
            'event_name' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_appointment' => 'nullable|boolean',
            'slot' => 'nullable',
        ], [
            'event_name.required' => 'Event name is required.',
            'start_date.required' => 'Start date is required.',
            'end_date.required' => 'End date is required.',
            'start_date.before_or_equal' => 'Start date must be on or before the end date.',
            'end_date.after_or_equal' => 'End date must be on or after the start date.',
        ]);

        $data = $request->all();
        $data['is_appointment'] = $request->boolean('is_appointment', false);
        $event = CalendarEvent::create($data);

        $user = User::where('role', 'Patient')->get();

        if ($event->is_appointment) {
            $patients = User::where('role', 'Patient')->get();
            foreach ($patients as $patient) {
                $patient->notify(new BlockAppointment($event));
            }
        }
        return response()->json($event, 201);
    }

    public function displayAppointment(){
        $data = Appointment::with('patient', 'appointServices')->whereNotIn('appnt_status', ['Declined'])->get();
        return $data;
    }
}
